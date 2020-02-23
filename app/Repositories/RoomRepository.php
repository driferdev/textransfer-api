<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository {

    public function create(): Room
    {
        $room = new Room();
        $room->name = $this->generateRoomName();
        $room->last_used = new \DateTime();
        $room->save();
        return $room;
    }

    public function open(string $name): ?Room
    {
        $room = Room::where('active', 1)
            ->where('name', $name)
            ->first();
        return $room;
    }

    private function generateRoomName(): string
    {
        $rooms = Room::where('active', 1)->get()->toArray();
        $usedNames = array_column($rooms, 'name');
        $name = \rand(00001, 99999);
        while(\in_array($name, $usedNames)) {
            $name = rand(1, 99999);
        }
        return $name;
    }
}