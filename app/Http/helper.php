<?php

if (!function_exists('setting')) {
    function setting()
    {
        return \App\Models\Setting::first();
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('brand')) {
    function brand()
    {
        return auth()->guard('brand');
    }
}

if (!function_exists('user_api')) {
    function user_api()
    {
        return auth()->guard('user_api');
    }
}

if (!function_exists('get_file')) {
    function get_file($file)
    {
        if (!is_null($file))
            return asset($file);
        else
            return asset('Admin/imgs/default.jpg');

    }
}

if (!function_exists('get_video_file')) {
    function get_video_file($file)
    {
        if (!is_null($file))
            return asset($file);
        else
            return null;
    }
}

if (!function_exists('my_toaster')) {
    function my_toaster($message = 'تم بنجاح', $alert_type = 'success')
    {
        session()->flash('message', $message);
        session()->flash('type', $alert_type);
    }
}

if (!function_exists('getToken')) {
    function getToken()
    {
        $token = null;
        if (request()->header('Authorization') && request()->header('Authorization') != null)
            $token = request()->header('Authorization');
        elseif (request()->get('Authorization') && request()->get('Authorization') != null)
            $token = request()->get('Authorization');
        elseif (request()->auth_token && request()->auth_token != null)
            $token = request()->auth_token;
        return substr($token, 7);
    }
}

if (!function_exists('getLanguage')) {
    function getLanguage($field)
    {
        $name = $field . '_ar';
        if (request()->header('lang') && request()->header('lang') != null)
            $name = $field . '_' . request()->header('lang');
        elseif (request()->get('lang') && request()->get('lang') != null)
            $name = $field . '_' . request()->get('lang');
        elseif (request()->lang && request()->lang != null)
            $name = $field . '_' . request()->lang;
        return $name;
    }
}

if (!function_exists('tableAction')) {
    function tableAction($id, $edit, $delete, $view = false)
    {
        $action = '';
        if ($edit) {
            $action .= '<button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 " data-toggle="tooltip" title="تعديل"
                                data-id="' . $id . '" ><i class="fa fa-edit text-white"></i>
                            </button>';
        }
        if ($delete) {
            $action .= '<button class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete" data-toggle="tooltip" title="حذف"
                                data-id="' . $id . '" ><i class="fa fa-trash-o text-white"></i>
                            </button>';

        }
        if ($view) {
            $action .= '<button class="btn btn-default btn-success btn-sm mb-2 mb-xl-0 view" data-toggle="tooltip" title="عرض"
                                data-id="' . $id . '" ><i class="fa fa-eye text-white"></i>
                            </button>';

        }
        return $action;
    }
}
