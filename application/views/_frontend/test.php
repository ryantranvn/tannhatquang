
<?
/* ======================= cau 1 */
    // create db with cat table.
    // note: path column include 2 parts.
        // example: row (4,'HP',2,'0-1-2-4-') has path is 0-1-2-4-
            // 0-1-2- : is path of parent
            // 4 : is id of this cat

    // step 1: get data by query => SELECT * FROM cat ORDER BY `path` ASC, `name` ASC;

    // step 2: add indent into array
    foreach ($categories as $key => $category) {
        $indent = count(explode('-', $category['path']));
        $categories[$key]['indent'] = $indent-1;
    }

    // step 3: print list
    echo '<ul>';
        echo '<li>';
            echo $categories[0]['name'];
            if (count($categories)>1) {
                for($i=1; $i<=count($categories)-1; $i++) {
                    if ($categories[$i]['indent'] == $categories[$i-1]['indent']) {
                        echo '</li><li>';
                    }
                    else if ($categories[$i]['indent'] > $categories[$i-1]['indent']) {
                        echo '<ul><li>';
                    }
                    else {
                        for ($j=0; $j<($categories[$i-1]['indent']-$categories[$i]['indent']); $j++) {
                            echo '</li></ul>';
                        }
                        echo '<li>';
                    }
                    echo $categories[$i]['name'];
                }
            }
        echo '</li>';
    echo '</ul>';

/* ======================= cau 2 */
$arr = array(array('module'=>'Admin',       'dependency'=>'Language')
            , array('module'=>'Language',   'dependency'=>'')
            , array('module'=>'Article',    'dependency'=>'Category')
            , array('module'=>'Order',      'dependency'=>'Cart')
            , array('module'=>'Cart',       'dependency'=>'Product')
            , array('module'=>'Banner',     'dependency'=>'File')
            , array('module'=>'Promotion',  'dependency'=>'Product')
            , array('module'=>'Category',   'dependency'=>'')
            , array('module'=>'Product',    'dependency'=>'Category')
            , array('module'=>'File',       'dependency'=>'')
);

$arrNew = array();
while (count($arr)>1) {
    $first = $arr[0];
    for ($i=1; $i<count($arr)-1; $i++) {
        if ($first['dependency']==$arr[$i]['module']) {
            array_push($arr, $first);
            break;
        }
    }
    if ($i==count($arr)-1) {
        array_push($arrNew, $first);
    }
    unset($arr[0]);
    $arr = array_values($arr);
}
$result = array_merge($arrNew, $arr);
print_r('<pre>');
print_r($result);
?>
