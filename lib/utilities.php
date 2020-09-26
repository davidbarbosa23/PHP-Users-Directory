<?php

use App\Models\User;

if (!function_exists('dd')) {
    function dd(...$values)
    {
        foreach ($values as $value) {
            var_dump($value);
        }
        die;
    }
}

if (!function_exists('view')) {
    function view($view, $params = [])
    {
        return \Response::view($view, $params);
    }
}

if (!function_exists('json')) {
    function json($data, $code = 200)
    {
        return \Response::json($data, $code);
    }
}

if (!function_exists('validate')) {
    function validate(
        $rules,
        $customMessages = []
    ) {
        $setMessageError = function ($customMessages, $type, $field, $value = null)
        {
            $messages = [
                'required' => 'The :attribute field is required.',
                'email' => 'The :attribute must be a valid email address.',
                'min' => 'The :attribute must be at least :value.',
                'max' => 'The :attribute may not be greater than :value.',
                'unique' => 'The :attribute has already been taken.',
                'equals' => 'The :attribute must be equal to :value.',
                'password' => 'The :attribute field is invalid.'
            ];
            $message = $customMessages[$type] ?? $messages[$type];
            $message = str_replace(':attribute', $field, $message);
            $message = str_replace(':value', $value, $message);

            return $message;
        };

        $request = new \Request;
        $errors = [];
        foreach ($rules as $field => $rule) {
            $rulesField = explode('|', $rule);
            foreach ($rulesField as $ruleField) {
                $isError = false;
                $attributes = explode(':', $ruleField);
                switch ($attributes[0]) {
                    case 'required':
                        if (empty($request->get($field))) {
                            $isError = true;
                        }
                        break;
                    case 'email':
                        if (!filter_var($request->get($field), FILTER_VALIDATE_EMAIL)) {
                            $isError = true;
                        }
                        break;
                    case 'min':
                        if (strlen($request->get($field)) < $attributes[1]) {
                            $isError = true;
                        }
                        break;
                    case 'max':
                        if (strlen($request->get($field)) > $attributes[1]) {
                            $isError = true;
                        }
                        break;
                    case 'unique':
                        $exist = User::where($field, $request->get($field))->exists();
                        if ($exist) {
                            $isError = true;
                        }
                        break;
                    case 'equals':
                        if ($request->get($field) !== $request->get($attributes[1])) {
                            $isError = true;
                        }
                        break;
                    case 'password':
                        if (preg_replace('/[^0-9]+/', '', $request->get($field)) === "") {
                            $errors[] = $setMessageError($customMessages, $attributes[0], $field);
                        }
                        break;
                }
                if ($isError) {
                    $errors[] = $setMessageError($customMessages, $attributes[0], $field, $attributes[1] ?? null);
                }
            }
        }

        $setMessageError = null;

        return $errors;
    }
}
