<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Repositories\LocationApiRepository;
use App\Repositories\LocationEloquentRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationController extends Controller
{
    public function  __construct(
        protected LocationApiRepository $locationApiRepository,
        protected LocationEloquentRepository $locationEloquentRepository
    ) {}

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource;
     */
    public function index(): JsonResource
    {
        $locations = $this->locationEloquentRepository->getAll();

        return LocationResource::collection($locations);
    }

    /**
     * Display the specified resource.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function search(LocationRequest $request): JsonResource
    {
        $userId = auth()->user()->id;
        $result = $this->locationApiRepository->forecast($request->all());
        
        if (isset($result['cod']) && $result['cod'] == 400) {
            return LocationResource::collection([[]]);
        }

        $icon = $result['weather'][0]['icon'];
        $weatherIcon = "https://openweathermap.org/img/wn/{$icon}@2x.png";

        $input = [
            'lat' => $result['coord']['lat'],
            'lng' => $result['coord']['lon'],
            'city' => $result['name'],
            'country' => $request->input('country'),
            'weather' => $result['weather'][0]['main'],
            'weather_description' => $result['weather'][0]['description'],
            'weather_icon' => $weatherIcon,
            'temp_min' => $result['main']['temp_min'],
            'temp_max' => $result['main']['temp_max'],
            'user_id' => $userId,
        ];

        $total = $this->locationEloquentRepository->totalByUser($userId);

        if ($total <= 3) {
            $this->locationEloquentRepository->store($input);
        }

        $locations = $this->locationEloquentRepository->getAll();

        return LocationResource::collection($locations); 
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(LocationRequest $request, string $id): JsonResource
    {
        $location = $this->locationEloquentRepository->findById($id);

        $this->locationEloquentRepository->update($location, $request->all());

        return new LocationResource($location);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function destroy(string $id): JsonResource
    {
        $location = $this->locationEloquentRepository->findById($id);

        $this->locationEloquentRepository->delete($id);

        return new LocationResource($location);
    }
}
