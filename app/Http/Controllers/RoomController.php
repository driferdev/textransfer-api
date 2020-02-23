<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoomRepository;
use mysql_xdevapi\Exception;

class RoomController extends Controller
{
    public function create(RoomRepository $roomRepository) {
        $newRoom = $roomRepository->create();
        return response()->json(['room' => $newRoom->name]);
    }

    public function open(string $name, RoomRepository $roomRepository) {
        $room = $roomRepository->open($name);
        if($room === null) {
            return response()->json([
                'error' => 'Room not found.'
            ], 404);
        }
        return response()->json([
            'room' => $room->name,
            'text' => $room->text ?? ''
        ]);
    }
}
