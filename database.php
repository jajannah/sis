<?php
class Database {
    private $file = 'students.json';

    public function read() {
        return json_decode(file_get_contents($this->file), true) ?: [];
    }

    public function write($data) {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
