<?php

namespace App\Http\Requests\Traits;

trait SmartQueryParams
{
    public function queryParameters(): array
    {
        $rules = method_exists($this, 'rules') ? $this->rules() : [];
        $attributes = method_exists($this, 'attributes') ? $this->attributes() : [];
        $output = [];

        foreach ($rules as $param => $rule) {
            $output[$param] = [
                'description' => $attributes[$param] ?? "Parameter `{$param}`",
                'example' => $this->generateExample($rule),
            ];
        }

        return $output;
    }

    private function generateExample($rule)
    {
        if (is_array($rule)) $rule = implode('|', $rule);

        return match (true) {
            str_contains($rule, 'integer') => 10,
            str_contains($rule, 'boolean') => true,
            str_contains($rule, 'email') => 'user@example.com',
            str_contains($rule, 'string') => 'contoh',
            str_contains($rule, 'date') => now()->toDateString(),
            str_contains($rule, 'in:asc,desc') => 'desc',
            default => 'value',
        };
    }
}