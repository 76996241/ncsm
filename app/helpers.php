<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/20 0020
 * Time: 16:20
 */

/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('MM'))
{
    function MM($var, $echo=true, $label=null, $strict=true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        }else
            return $output;
    }
}

/**
 * 获得分类函数
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('NcGetType'))
{
    function NcGetType($pid='',$keys='') {
        $flight = new \App\Post_cate();
        if($keys=='1'){
            $model =  $flight->find($pid);
            return $model;
        }elseif($keys=='2'){
            $model =  $flight->find($pid);
            return $model->name;
        }elseif($keys=='3'){
            $model =  $flight->where('slug',$pid)->orderBy('sequence','asc')->get();
            return $model;
        }elseif($keys=='4'){
            $model =  $flight->find($pid);
            $i=0;

                $models['id']=$model['id'];
                $models['pid']=$model['pid'];
                $models['name']=$model['name'];
                $models['slug']=$model['slug'];
                $models['sequence']=$model['sequence'];
                $models['taxonomy']=$model['taxonomy'];
                $models['description']=$model['description'];
                $models['count']=$model['count'];
                $models['uid']=$model['uid'];

            return $models;
        }else{
            $model =  $flight->where('pid',$pid)->orderBy('sequence','asc')->get();
            $i=0;
            $models=array();
            foreach ($model as $key=> $value){
                    $models[$i]['id']=$value['id'];
                    $models[$i]['pid']=$value['pid'];
                    $models[$i]['name']=$value['name'];
                    $models[$i]['slug']=$value['slug'];
                    $models[$i]['sequence']=$value['sequence'];
                    $models[$i]['taxonomy']=$value['taxonomy'];
                    $models[$i]['description']=$value['description'];
                    $models[$i]['count']=$value['count'];
                    $models[$i]['uid']=$value['uid'];
                    $i++;
            }
        }

        return $models;
    }
}
/**
 * 初始化分类函数
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('NcGetTypeS'))
{
    function NcGetTypeS($pid='',$keys='') {
        $flight = new \App\Post_cate();
        $html='';
        if($pid){
            $nav= $flight->find($pid);
            if($keys==1){
                $model =  $flight->where('id',$nav['id'])->get();
                foreach ($model as $list){
                    $html.="<option value=\"$list->id\">".$list->name."</option>";
                }
                $model =  $flight->where('pid',$nav['id'])->get();
                foreach ($model as $list){
                    $html.="<option value=\"$list->id\">---  ".$list->name."</option>";
                }
                $model=array();
            }elseif($keys==2){
                $html='<option value="0">无节点</option>';
                $model =  $flight->where('pid',$nav['pid'])->get();
                foreach ($model as $list){
                    if($pid==$list->id){
                        $html.="<option value=\"$list->id\" selected=\"selected\" >".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
                $model =  $flight->where('pid',$pid)->get();
                foreach ($model as $list){
                    $html.="<option value=\"$list->id\">---  ".$list->name."</option>";
                }
                $model=array();
            }else{
                $model =  $flight->where('pid',$nav['pid'])->get();
            }

        }else{
            $html='<option value="0">无节点</option>';
            $model=array();
            //if($keys==2){
                $model =  $flight->where('pid','0')->get();
           // }
        }
        foreach ($model as $list){
            $html.="<option value=\"$list->id\">".$list->name."</option>";
        }
        return $html;

    }
}
/**
 * 获得分类子集数量
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('NcGetCount'))
{
    function NcGetCount($id='',$keys='') {
        $flight = new \App\Post_cate();
        $num =  $flight->where('pid',$id)->count();
        return $num;
    }
}

/**
 * 获得循环分类
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('NcGetList')) {
    function NcGetList($pid = '', $keys = '')
    {
        //获取全部函数权限
        $authority = NcGetType($pid);
        $i = 0;
        foreach ($authority as $key => $value) {
            $authority[$i]['subset'] = NcGetType($value['id']);
            $authority[$i]['disabled'] = 'disabled="disabled"';
            $m = 0;
            foreach ($authority[$i]['subset'] as $value1) {
                $authority[$i]['subset'][$m]['subset'] = NcGetType($value1['id']);
                if(count($authority[$i]['subset'][$m]['subset'])>1){
                $authority[$i]['subset'][$m]['disabled'] = 'disabled="disabled"';
                }else{
                $authority[$i]['subset'][$m]['disabled'] = '';
                }
                $n = 0;
                foreach ($authority[$i]['subset'][$m]['subset'] as $value2) {
                    $authority[$i]['subset'][$m]['subset'][$n]['subset'] = NcGetType($value2['id']);
                    if(count($authority[$i]['subset'][$m]['subset'][$n]['subset'] )>1){
                        $authority[$i]['subset'][$m]['subset'][$n]['disabled'] = ' disabled="disabled"';
                    }else{
                        $authority[$i]['subset'][$m]['subset'][$n]['disabled'] ='';
                    }
                    $n++;
                }
                $m++;
            }
            $i++;
        }
        return $authority;
    }
}

/**
 * POST数据转化成数组
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('NcGetArray'))
{
    function NcGetArray($arr='') {
        $arr=str_replace('[','',$arr);
        $arr=str_replace(']','',$arr);
        $arr=str_replace('"','',$arr);
        $arr=explode(',',$arr);
        return($arr);
    }
}

/**
 * POST数据转化成数组
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('NcGetAuthority'))
{
    function NcGetAuthority($user_group='') {
        $Authority = new \App\Authority();
        $dataAuthority = $Authority->where('cateid', $user_group)->get();
        $nav = json_decode($dataAuthority['0']['description']);
        return $nav;
    }
}

/**
 * 初始化分类函数，下来列表
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('NcGetTypeNews'))
{
    function NcGetTypeNews($pid='',$keys='',$type='') {
        $flight = new \App\Post_cate();
        $html='';
        if($pid){
            if($keys=='1'){
                $model =  $flight->where('pid',$pid)->get();
                foreach ($model as $list){
                    if($type==$list->id){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='2'){
                $model =  $flight->where('pid',$pid)->get();
                $html.="<option value=\"0\">所有类别</option>";
                foreach ($model as $list){
                    if($type==$list->id){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='3'){
                $model =  $flight->where('pid',$pid)->get();
                $html.="<option value=\"0\">量具类型</option>";
                foreach ($model as $list){
                    if($type==$list->id){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='4'){
                $model =  $flight->where('pid',$pid)->get();
                $html.="<option value=\"0\">量具品牌</option>";
                foreach ($model as $list){
                    if($type==$list->id){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='5'){
                $model =  $flight->where('pid',$pid)->get();
                $data = $flight->find($pid);

                if($pid=='70' or $pid=='71'){
                    $html.="<div style='height: 60px'>";
                    foreach ($model as $list){
                        if(strpos(','.$type.',',','.$list->id.',') !== false){
                            $html.="<li><input type=\"checkbox\" checked=\"checked\" name=\"questions-Knowledge[]\" id=\"questions-Knowledge\" value=\"".$list->id."\"> ".$list->name."</li>";
                        }else{
                            $html.="<li><input type=\"checkbox\"  name=\"questions-Knowledge[]\" id=\"questions-Knowledge\" value=\"".$list->id."\"> ".$list->name."</li>";;
                        }
                    }
                    $html.="</div><div><small>必选项</small></div>";
                }else{
                    $html.="<option value=\"0\">".$data['name']."</option>";
                    foreach ($model as $list){
                        if($type==$list->id){
                            $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                        }else{
                            $html.="<option value=\"$list->id\">".$list->name."</option>";
                        }
                    }
                }


            }elseif ($keys=='6'){
                $model =  $flight->where('pid',$pid)->get();
                $html.="<option value=\"0\">试题用途</option>";
                foreach ($model as $list){
                    if($type==$list->id){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='7'){
                $model =  $flight->where('pid',$pid)->get();
                foreach ($model as $list){
                    if($type==$list->id){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='8'){
                $model =  $flight->where('pid',$pid)->get();
                foreach ($model as $list){
                    if($type==$list->id){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='9'){
                $model =  $flight->where('pid',$pid)->get();
                foreach ($model as $list){
                    if(strpos(','.$type.',',','.$list->id.',') !== false){
                        $html.="<li><input type=\"radio\" checked=\"checked\" name=\"user_user_group\" id=\"user-user_group\" value=\"".$list->id."\"> ".$list->name."</li>";
                    }else{
                        $html.="<li><input type=\"radio\"  name=\"user_user_group\" id=\"user-user_group\" value=\"".$list->id."\"> ".$list->name."</li>";;
                    }
                }
            }elseif ($keys=='10'){
                $model =  $flight->where('pid',$pid)->get();
                $data = $flight->find($pid);
                $types=explode('|',$type);
                if(in_array(0,$types)){
                    $html.="<option value=\"0\" selected>".$data['name']."</option>";
                }else{
                    $html.="<option value=\"0\">".$data['name']."</option>";
                }
                foreach ($model as $list){
                    if(in_array($list->id,$types)){
                        $html.="<option value=\"$list->id\" selected='selected'>".$list->name."</option>";
                    }else{
                        $html.="<option value=\"$list->id\">".$list->name."</option>";
                    }
                }
            }elseif ($keys=='11'){
                $model =  $flight->where('pid',$pid)->get();
                return $model;
            }else{

            }
        }else{
            $model =  $flight->where('pid','0')->get();
            foreach ($model as $list){
                $html.="<option value=\"$list->id\">".$list->name."</option>";
            }
        }

        return $html;

    }
}

/**
 * 对象转数组
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
if(!function_exists('object_array'))
{
    function object_array($array) {
        if(is_object($array)) {
            $array = (array)$array;
        }
        if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = object_array($value);
            }
        }
        return $array;
    }
}


//PHP stdClass Object转array
if(!function_exists('object_arrays')){
    function object_arrays($array) {
        if(is_object($array)) {
            $array = (array)$array;
        }
        if(is_array($array)) {
            foreach($array as $key=>$value) {
                $arrays[$key] = $value;
            }
        }
        return $arrays;
    }
}
//获取测量成绩
if(!function_exists('getResults')){
    function getResults($aspectsize,$aspecterrora,$aspecterrorb,$maxmark,$get,$key) {
        if($key=='66') {
            if ($aspecterrora <= $aspecterrorb) {
                $a = $aspectsize + $aspecterrora;
                $b = $aspectsize + $aspecterrorb;
            }
            if ($aspecterrora > $aspecterrorb) {
                $a = $aspectsize + $aspecterrorb;
                $b = $aspectsize + $aspecterrora;
            }


            if ($a <= $b) {
                if ($a <= $get and $b>=$get) {
                    $results = $maxmark;
                }else {
                    $results = '0';
                }


            } else {
                $results = 'error';
            }
        }//return $a.'-'.$b.'-'.$results.'-'.$get.'-'.$key;
        if($key=='67') {
            if($get=='1'){
                $results = $maxmark;
            }elseif($get=='0'){
                $results = '0';
            }else{
                $results = 'error';
            }
        }
        return $results;
    }

}