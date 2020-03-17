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

    public function getRoom(string $name): ?Room
    {
        $room = Room::where('active', 1)
            ->where('name', $name)
            ->first();
        return $room;
    }

    public function updateLastUsed(Room $room): bool
    {
        $room->last_used = new \DateTime();
        return $room->save();
    }

    private function generateRoomName(): string
    {
        $rooms = Room::where('active', 1)->get()->toArray();
        $usedNames = array_column($rooms, 'name');
        $name = \rand(1, 99999);
        while(\in_array($name, $usedNames)) {
            $name = \rand(1, 99999);
        }
        return $name;
    }
}