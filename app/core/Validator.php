<?php

namespace App\Core;

use FrErrorMessages;

class Validator
{
    private static array $errors = [];
    private static array $data = [];

    private static array $validationMessages = [
        'required' => FrErrorMessages::REQUIRED->value,
        'email' => FrErrorMessages::EMAIL->value,
        'unique_email' => FrErrorMessages::UNIQUE_EMAIL->value,
        'min' => FrErrorMessages::MIN->value,
        'max' => FrErrorMessages::MAX->value,
        'numeric' => FrErrorMessages::NUMERIC->value,
        'integer' => FrErrorMessages::INTEGER->value,
        'date' => FrErrorMessages::DATE->value,
        'date_format' => FrErrorMessages::DATE_FORMAT->value,
        'regex' => FrErrorMessages::REGEX->value,
        'in' => FrErrorMessages::IN->value,
        'same' => FrErrorMessages::SAME->value,
        'after' => FrErrorMessages::DATE_AFTER->value,
        'file_mime' => FrErrorMessages::FILE_MIME->value,
        'file_size' => FrErrorMessages::FILE_SIZE->value,
        'senegal_phone' => 'Numéro de téléphone invalide.',
        'senegal_nin' => 'Numéro d\'indentification nationale invalide.',
        'unique' => FrErrorMessages::UNIQUE->value,
    ];

    private static array $validators = [];

    public static function initValidators(): void
    {
        self::$validators = [
            'required' => fn($value) => !empty($value),
            'email' => fn($value) => filter_var($value, FILTER_VALIDATE_EMAIL),
            'min' => fn($value, $param) => is_string($value) ? (strlen($value) >= (int)$param) : ($value >= (int)$param),
            'max' => fn($value, $param) => is_string($value) ? (strlen($value) <= (int)$param) : ($value <= (int)$param),
            'min_max' => fn($value, $params) => is_string($value) ? (strlen($value) >= (int)$params[0] && strlen($value) <= (int)$params[1]) : ($value >= (int)$params[0] && $value <= (int)$params[1]),
            'numeric' => fn($value) => is_numeric($value),
            'integer' => fn($value) => filter_var($value, FILTER_VALIDATE_INT) !== false,
            'date' => fn($value) => strtotime($value) !== false,
            'date_format' => fn($value, $param) => \DateTime::createFromFormat($param, $value) !== false,
            'regex' => fn($value, $param) => preg_match($param, $value),
            'in' => fn($value, $param) => in_array($value, explode(',', $param)),
            'same' => fn($value, $param) => $value === (self::$data[$param] ?? null),
            'after' => fn($value, $param) => strtotime($value) > strtotime($param),
            // 'file_mime' => fn($value, $param) => is_array($value) && isset($value['type']) && in_array($value['type'], explode(',', $param)),
            'file_mime' => function ($file, $types) {
                if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) return false;
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);
                return in_array($mime, explode(',', $types));
            },
            // 'file_size' => fn($value, $param) => is_array($value) && isset($value['size']) && $value['size'] <= (int)$param,
            // 'senegal_phone' => fn($value) => preg_match('/^(77|78|76|70|75)[0-9]{7}$/', $value),
            // 'senegal_nin' => fn($value) => preg_match('/^[12][0-9]{12}$/', $value),
            // 'unique' => function ($value, $repositoryClass) {
            //     return !self::exists($value, $repositoryClass);
            // },
        ];
    }

    // private static function exists($value, $repositoryClass): bool
    // {
    //     $namespace = 'App\\Repository\\';
    //     $repositoryClass = $namespace . $repositoryClass;
    //     if (!class_exists($repositoryClass)) {
    //         error_log("Repository class $repositoryClass does not exist.");
    //         return false;
    //     }
    //     $repository = App::getDependency($repositoryClass);
    //     if (!method_exists($repository, 'exists')) {
    //         error_log("Method 'exists' not found in repository class $repositoryClass.");
    //         return false;
    //     }
    //     return $repository->exists($value);
    // }

    public static function validate(array $data, array $rules): void
    {
        if (empty(self::$validators)) {
            self::initValidators();
        }

        self::$errors = [];
        self::$data = $data;

        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? ($_FILES[$field] ?? null);

            if (empty($value)) {
                if (in_array('required', $fieldRules)) {
                    self::addError($field, sprintf(self::$validationMessages['required'], $field));
                }
                continue;
            }

            foreach ($fieldRules as $rule) {
                $ruleName = $rule;
                $param = null;

                if (str_contains($rule, ':')) {
                    [$ruleName, $param] = explode(':', $rule, 2);
                }

                if (!isset(self::$validators[$ruleName])) {
                    continue;
                }

                $validator = self::$validators[$ruleName];
                $isValid = $param === null ? $validator($value) : $validator($value, $param);

                if (!$isValid) {
                    $message = self::$validationMessages[$ruleName] ?? 'Erreur de validation.';

                    if (substr_count($message, '%s') === 2 && $param !== null) {
                        $message = sprintf($message, $field, $param);
                    } elseif (substr_count($message, '%s') === 1) {
                        $message = sprintf($message, $field);
                    }

                    self::addError($field, $message);
                }
            }
        }
    }

    public static function addError(string $field, string $message): void
    {
        self::$errors[$field][] = $message;
    }

    public static function isValid(): bool
    {
        return empty(self::$errors);
    }

    public static function getErrors(): array
    {
        return self::$errors;
    }

    public static function getFirstError(): ?string
    {
        foreach (self::$errors as $errors) {
            if (!empty($errors)) {
                return $errors[0];
            }
        }
        return null;
    }

    public static function reset(): void
    {
        self::$errors = [];
        self::$data = [];
    }

    public static function addCustomRule(string $ruleName, callable $validator, string $message): void
    {
        self::$validators[$ruleName] = $validator;
        self::$validationMessages[$ruleName] = $message;
    }
}


