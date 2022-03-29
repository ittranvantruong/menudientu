<?php

if (!function_exists('optionRole')) {
    function optionRole($role = 'role-user')
    {
        $html = '';
        foreach (config('mevivu.role.user') as $key => $value) {
            $html .= '<option value="' . $key . '">' . $value . '</option>';
        }
        return $html;
    }
}

if (!function_exists('optionRoleSelected')) {
    function optionRoleSelected($role = 'role-user', $selected = 'customer')
    {
        $html = '';
        foreach (config('mevivu.role.user') as $key => $value) {
            $html .= '<option '.selected($selected, $key).' value="' . $key . '">' . $value . '</option>';
        }
        return $html;
    }
}
if (!function_exists('selected')) {
    function selected($value1, $value2){
        if($value1 == $value2){
            return 'selected';
        }
        return;
    }
}

if (!function_exists('checked')) {
    function checked($value1, $value2){
        if($value1 == $value2){
            return 'checked';
        }
        return;
    }
}
if (!function_exists('showRole')) {
    function showRole($value, $option = 'user'){
        $type = config('mevivu.role.'.$option);
        return $type[$value];
    }
}
if (!function_exists('status')) {
    function status($value){
        if($value == 1){
            return '<span class="badge badge-success">Hiện</span>';
        }
        return '<span class="badge badge-secondary">Ẩn</span>';

    }
}
if (!function_exists('orderStatus')) {
    function orderStatus($value){
        if(isset($value) && ($value || $value == 0)){
            return config('mevivu.order.status')[$value];
        }
        return '';

    }
}
if (!function_exists('getPriceMinMax')) {
    function getPriceMinMax($price, $data, $option = 'html'){
        $collect = collect();
        if(count($data) < 1 && $price == null){
            return '0đ';
        }elseif(count($data) < 1 && $price != null){
            return number_format($price).'đ';
        }else{
            foreach($data as $item) {
                // dd($item);
                $collect = $collect->mergeRecursive($item->product_attribute_variation[0]);
            
            }
            $collect = collect([
                'max_price' => collect($collect['max_price'])->max(),
                'min_price' => collect($collect['min_price'])->min()
            ]);
            if($option == 'html'){
                return number_format($collect['min_price']).'đ - '.number_format($collect['max_price']).'đ';
            }
            return $collect;
        }
        
    }
}
