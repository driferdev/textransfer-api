<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepository;

class RoomController extends Controller
{
    public function create(RoomRepository $roomRepository) {
        $newRoom = $roomRepository->create();
        return response()->json(['room' => $newRoom->name]);
    }

    public function getRoom(string $name, RoomRepository $roomRepository) {
        $room = $roomRepository->getRoom($name);
        if($room === null) {
            return response()->json([
                'error' => 'Room not found.'
            ], 404);
        }
        $roomRepository->updateLastUsed($room);
        return response()->json([
            'room' => $room->name,
            'text' => $room->text ?? ''
        ]);
    }
}
