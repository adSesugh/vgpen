<?php

namespace App\Support;


use DB;

class Settings
{
    public function get($key)
    {
        $found = $this->db()
            ->where('key', $key)
            ->first();

        return optional($found)->value;
    }

    public function getMany($keys)
    {
        $output = [];

        foreach ($keys as $type => $key) {
            $output[$key] = $this->get($key);
        }

        return $output;
    }

    public function set($key, $value)
    {
        return $this->db()
            ->where('key', $key)
            ->update(['value' => $value]);
    }

    public function setMany($array)
    {
        foreach ($array as $key => $value) {
            $this->db()
                ->where('key', $key)
                ->update(['value' => $value]);
        }
    }

    public function forget($key)
    {
        return $this->set($key, null);
    }

    protected function db()
    {
        return DB::table('settings');
    }
}
