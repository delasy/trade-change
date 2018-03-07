<?php

namespace App\Helpers;

class AppHelper {
    /**
     * Web-site meta name.
     *
     * @return string
     */
    public static function getMetaName() {
        return 'Trade-Change';
    }
    /**
     * Web-site meta title.
     *
     * @return string
     */
    public static function getMetaTitle() {
        return 'Trade Change - Единственный обменник нужный тебе';
    }

    /**
     * Web-site meta description
     *
     * @return string
     */
    public static function getMetaDescription() {
        return 'Trade Change - это Ваш личный обменный пункт электронных денег и криптовалют по самому лучшему '
            . 'курсу. Так же с нами Вы можете продать биткоин свои партнерам, взяв нашу площадку, как сервис '
            . 'посредник. Покупайте и продавайте ВЫГОДНО!';
    }

    /**
     * Web-site meta keywords.
     *
     * @return string
     */
    public static function getMetaKeywords() {
        return 'trade, change, trade-change, обменник, обмен, обмен валют, валюта, курс, курс валют, выгодный '
            . 'обменник, обмен валют';
    }

    /**
     * Parsing string into arrays and than call
     *
     * @param string $msg
     * @param string $chat
     * @return array
     */
    public static function sendTelegramMessage($msg, $chat = '') {
        $msg = strval($msg);
        $chat = strval($chat);

        if ($msg === '') return [];
        $chat = $chat === '' ? env('TELEGRAM_CHAT', '') : $chat;
        if ($chat === '') return [];
        if (strval(env('TELEGRAM_BOT_TOKEN', '')) === '') return [];

        $return = [];

        if (strpos($chat, ',') === false) {
            $return[] = self::processTelegramMessage($msg, $chat);
        } else {
            $chats = explode(',', $chat);

            foreach ($chats as $chat) {
                $return[] = self::processTelegramMessage($msg, $chat);
            }
        }

        return $return;
    }

    /**
     * Sends message to telegram.org messenger.
     *
     * @param string $msg
     * @param string $chat
     * @return array
     */
    public static function processTelegramMessage($msg, $chat = '') {
        $msg = strval($msg);
        $chat = strval($chat);

        if ($msg === '') return [];
        $chat = $chat === '' ? env('TELEGRAM_CHAT', '') : $chat;
        if ($chat === '') return [];
        if (strval(env('TELEGRAM_BOT_TOKEN', '')) === '') return [];

        $base_path = str_replace('/private/var/www/', '/var/www/', base_path()); // for MacOS

        $msg .= PHP_EOL . 'Окружение приложения: <b>' . env('APP_ENV', 'local') . '</b>' . PHP_EOL
        . 'Каталог приложения: <b>' . $base_path . '</b>';

        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage?parse_mode=HTML&chat_id='
            . $chat . '&text=' . urlencode($msg);

        $ch = curl_init();
        curl_setopt_array($ch, [CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true]);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    /**
     * Return nav-here if current path begins with this path.
     *
     * @param string $current_path
     * @param string $path
     * @param bool $with_class
     * @return string
     */
    public static function setActiveMenu($current_path, $path, $with_class = false) {
        $return = $current_path === $path ? 'mdc-temporary-drawer--selected' : '';

        if ($return !== '') {
            if ($with_class) {
                $return = "class=\"$return\"";
            } else {
                $return = " $return";
            }
        }

        return $return;
    }

    /**
     * Makes HTML from tags array.
     *
     * @param string|array $tree
     * @param $errors
     * @return string
     * @throws \Exception
     */
    public static function toHTML($tree, $errors) {
        $html = '';

        if (gettype($tree) === 'string') {
            $html .= $tree;
        } elseif (gettype($tree) === 'array') {
            foreach ($tree as $tag_name => $tag_attributes) {
                $tag_name = preg_replace('/[0-9]+/', '', $tag_name);
                $tag_html = '';

                if ($tag_name === 'raw') {
                    $html .= $tag_attributes;
                    continue;
                }

                $tag_html .= "<$tag_name";
                $tag_content = '';
                $post_tag_content = '';

                if (
                    isset($tag_attributes['HTML'])
                    && isset($tag_attributes['HTML']['input']) && isset($tag_attributes['HTML']['input']['name'])
                    && $errors->has($tag_attributes['HTML']['input']['name'])
                ) {
                    $post_tag_content .= '<div class="mdc-text-field-helper-text '
                        . 'mdc-text-field-helper-text--validation-msg">'
                        . $errors->first($tag_attributes['HTML']['input']['name']) . '</div>';

                    if (isset($tag_attributes['class']) && $tag_attributes['class']) {
                        $tag_attributes['class'] .= ' mdc-text-field--invalid';
                    } else {
                        $tag_attributes['class'] = 'mdc-text-field mdc-text-field--invalid';
                    }
                }

                if (isset($tag_attributes['if']) && boolval($tag_attributes['if']) !== true) {
                    continue;
                }

                foreach ($tag_attributes as $attribute_name => $attribute_value) {
                    if ($attribute_name === 'HTML' || is_array($attribute_value)) {
                        $tag_content .= self::toHTML($attribute_value, $errors);
                    } elseif ($attribute_value === 'required') {
                        $tag_html .= ' required';
                    } elseif ($attribute_value === 'disabled') {
                        $tag_html .= ' disabled';
                    } else {
                        $tag_html .= " $attribute_name=\"$attribute_value\"";
                    }
                }

                $tag_html .= ">";

                if (!in_array($tag_name, ['input', 'hr', 'img'])) {
                    $tag_html .= "$tag_content</$tag_name>$post_tag_content";
                }

                $html .= $tag_html;
            }
        } else {
            throw new \Exception('Unknown type of HTML tree.');
        }

        return $html;
    }

    /**
     * Makes HTML select options list from params.
     *
     * @param array $params
     * @param string $default_value
     * @param string $selected_value
     * @param string|callable $value_key
     * @param string|callable $text_key
     * @return string
     */
    public static function toSelectOptions($params, $default_value, $selected_value, $value_key, $text_key) {
        $html = '';

        $html .= "<option selected disabled value=\"\">$default_value</option>";

        foreach ($params as $param) {
            $text = is_callable($text_key) ? strval($text_key($param)) : strval($param->{$text_key});
            $value = is_callable($value_key) ? strval($value_key($param)) : strval($param->{$value_key});
            $is_selected = $value === strval($selected_value) ? ' selected' : '';

            $html .= "<option$is_selected value=\"$value\">$text</option>";
        }

        return $html;
    }

    /**
     * Generates a password of N length containing at least one lower case letter, one uppercase letter, one digit,
     * and one special character. The remaining characters in the password are chosen at random from those four sets.
     *
     * The available characters in each set are user friendly - there are no ambiguous character
     * such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
     * makes it much easier for users to manually type or speak their passwords.
     *
     * Note: the $add_dashes option will increase the length of the password by floor(sqrt(N)) characters.
     *
     * @param int $length
     * @param bool $add_dashes
     * @param string $available_sets
     * @return string
     */
    public static function generatePassword($length = 9, $add_dashes = false, $available_sets = 'luds') {
        $sets = [];

        if (strpos($available_sets, 'l') !== false) {
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        }

        if (strpos($available_sets, 'u') !== false) {
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        }

        if (strpos($available_sets, 'd') !== false) {
            $sets[] = '23456789';
        }

        if (strpos($available_sets, 's') !== false) {
            $sets[] = '!@#$%&*?';
        }

        $all = '';
        $password = '';

        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);

        for ($i = 0; $i < $length - count($sets); $i++) $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if (!$add_dashes) return $password;

        $dash_len = floor(sqrt($length));
        $dash_str = '';

        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }

        $dash_str .= $password;

        return $dash_str;
    }

    /**
     * Encodes ex_order to be passed to frontend for ajax requests.
     *
     * Algorithm:
     * - converts user.id to 11 digits string by adding zeros in front of it, like so:
     * user.id = 1
     * converted user.id = 00000000001
     * - same convertation for ex_order.id
     * - then we're create $code variable by concatenation $ex_order_id with $user_id
     * - then we're calculating check sum
     * - then we're concatenating code variable with chec sum
     *
     *
     * @param integer $ex_order_id
     * @param integer $user_id
     * @return string
     * @throws \Exception
     */
    public static function encodeExOrder($ex_order_id, $user_id) {
        $ex_order_id = strval($ex_order_id);
        $user_id = strval($user_id);

        if ($ex_order_id === '') {
            throw new \Exception('Wrong ex_order.id');
        } elseif ($user_id === '') {
            throw new \Exception('Wrong user.id');
        }

        for ($i = strlen($ex_order_id); $i < 11; $i++) {
            $ex_order_id = 0 . $ex_order_id;
        }

        for ($i = strlen($user_id); $i < 11; $i++) {
            $user_id = 0 . $user_id;
        }

        $code = $ex_order_id . $user_id;

        $check_sum = 0;

        for ($i = 0; $i < 22; $i++) {
            $digit = substr($code, $i, 1);

            if (($i % 2) !== 0) {
                $check_sum = $check_sum + $digit * 3;
            } else {
                $check_sum = $check_sum + $digit * 1;
            }
        }

        $check_sum = (10 - ($check_sum % 10) ) % 10;

        return hash('sha256', $code . $check_sum);
    }
}
