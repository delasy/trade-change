<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BaseModel extends Model {
    /**
     * Method for all models, that returns called model table name.
     *
     * @return string
     */
    public static function tableName() {
        return self::getCalleeInstance()->getTable();
    }

    /**
     * Extracts current callee class name.
     *
     * @return mixed
     */
    public static function getCalleeInstance() {
        $callee_class_name = get_called_class();
        return with(new $callee_class_name);
    }

    /**
     * Checks if data can be inserted in current model.
     *
     * @param array $data
     * @param int $edit_id
     * @return bool
     */
    public static function safeInsertCheck(array $data, $edit_id = 0) {
        $model = self::getCalleeInstance();
        $model_rules = $model->getRules($edit_id);

        $validator = Validator::make($data, $model_rules);

        return $validator->fails() ? $validator : true;
    }

    /**
     * Inserts data to callee model in safe mode.
     *
     * @param $data
     * @param int $edit_id
     * @return mixed
     * @throws ValidationException
     */
    public static function safeCreate(array $data, $edit_id = 0) {
        $model = self::getCalleeInstance();
        $create_data = [];

        foreach ($model->getRules($edit_id) as $rule_name => $rule_value) {
            if (isset($data[$rule_name])) {
                $value = $data[$rule_name];

                if ($rule_name === 'password') {
                    $value = bcrypt($value);
                }

                $create_data[$rule_name] = $value;
            }
        }

        if (empty($create_data)) {
            throw ValidationException::withMessages([
                'backend_error' => 'Данное действие не возможно завершить.'
            ]);
        }

        try {
            $model_instance = $model::create($create_data);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'backend_error' => 'Не возможно завершить данное действие.'
            ]);
        }

        return $model_instance;
    }

    /**
     * Updates data in callee model in safe mode.
     *
     * @param array $data
     * @param integer $edit_id
     * @return mixed
     * @throws ValidationException
     */
    public static function safeFill(array $data, $edit_id) {
        $model = self::getCalleeInstance();

        $model_instance = $model::find($edit_id);
        if (!$model_instance) {
            return false;
        }

        foreach ($model->getRules($edit_id) as $rule_name => $rule_value) {
            if (isset($data[$rule_name])) {
                $model_instance->{$rule_name} = $data[$rule_name];
            }
        }

        try {
            $model_instance->save();
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'backend_error' => 'Не возможно завершить данное действие.'
            ]);
        }

        return $model_instance;
    }

    /**
     * Deactivates need model.
     *
     * @param integer $id
     * @return mixed
     */
    public static function safeDeactivate($id) {
        $model = self::getCalleeInstance();
        $model_instance = $model::find($id);

        if (!$model_instance) {
            return false;
        }

        $model_instance->deactivate();
        return $model_instance;
    }

    /**
     * Return found row in model.
     *
     * @param integer $id
     * @return mixed
     */
    public static function safeFind($id) {
        $model = self::getCalleeInstance();
        return $model::find($id);
    }
}
