<?php 
if($_POST['is_done']){
    update_post_meta($_POST['is_done'], 'is_done', 'true');
}
$args = array(
    'numberposts' => -1,
    'post_type'   => 'sfwd-courses'
  );
$questionArgs = array(
    'numberposts' => -1,
    'post_type'  => 'fxminds_further_qa',
    'meta_query' => array(
        array(
            'key'     => 'is_done',
            'value'   => 'false',
        ),),
    'orderby' => 'date',
    'order' => 'ASC'
);

$courses = array_map(function($course){
    return array('ID' => $course->ID, 'title' => $course->post_title);
},get_posts( $args ));

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

$lessonQA = unique_multidim_array(array_map(function($question){
    $lessonId = get_post_meta($question->ID, 'lesson_id', true);
    $query = new WP_Query( array(
        'post_type'  => 'fxminds_further_qa',                   
        'meta_query' => array(
        array(
            'key'     => 'lesson_id',
            'value'   => $lessonId,
        ),
        array(
            'key'     => 'is_done',
            'value'   => 'false',
        ),)) );
    return array(
        'course_id' => get_post_meta($question->ID, 'course_id', true),
        'lesson' => array(
            'ID' => $lessonId,
            'name' => get_post_meta($question->ID, 'lesson_name', true)
        ),
        'count' => $query->found_posts
        );
}, get_posts($questionArgs)), 'lesson');

?>

<div class="wrap fxminds-admin">
    <header>
        <h1>FXMinds Students<span>Verdiepingsvragen</span></h1>
    </header>
    <section>
    <?php if(!$_GET['lesson']):?>
        <div class="fxminds-table">
                <div class="table-head">
                    <div>
                        Cursus
                    </div>
                    <div>
                        Les
                    </div>
                    <div>
                        Aantal vragen
                    </div>
                    <div>Acties</div>
                </div>
                <div class="table-body">

                <?php foreach($lessonQA as $question): 
                    ?>
                <div class="table-row">
                    <div >
                    <?php echo $courses[array_search($question['course_id'], array_column($courses, 'ID'))]['title']; ?>
                    </div>
                    <div >
                    <?php echo $question['lesson']['name']; ?>
                    </div>
                    <div >
                    <?php echo $question['count']; ?>
                    </div>
                    <div>
                    <a href="/wp-admin/admin.php?page=fxminds_verdieping&lesson=<?php echo $question['lesson']['ID'];?>">Bekijk vragen</a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            </div>
        </div>
                <?php else: ?>


                <?php 
                    
                    $questionArgs = array(
                        'numberposts' => -1,
                        'post_type'  => 'fxminds_further_qa',
                        'meta_query' => array(
                            array(
                                'key'     => 'lesson_id',
                                'value'   => "{$_GET['lesson']}",
                            ),
                            array(
                                'key'     => 'is_done',
                                'value'   => 'false',
                            ),)
                    );
                    $questions = get_posts($questionArgs);
                ?>
                <a href="/wp-admin/admin.php?page=fxminds_verdieping">Terug naar overzicht</a><br/><br/>
                    <div class="fxminds-table questions">
                <div class="table-head">
                    <div>
                        Les
                    </div>
                    <div>
                        Onderwerp
                    </div>
                    <div>
                        Vraag
                    </div>
                    <div>
                        Student
                    </div>
                    <div>Acties</div>
                </div>
                <div class="table-body">

                <?php foreach($questions as $question): 
                    ?>
                <div class="table-row ">
                    <div >
                        <?php echo get_post_meta($question->ID, 'lesson_name', true);?>
                    </div>
                    <div >
                    <?php echo $question->post_title;?>
                    </div>
                    <div >
                    <?php echo $question->post_content;?>
                    </div>
                    <div>
                    <?php echo get_post_meta($question->ID, 'student', true);?>
                    </div>
                    <div>
                        <form method="POST">
                            <button name="is_done" value="<?php echo $question->ID; ?>" type="submit">Verwerk</button>
                        </form>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            </div>
        </div>

                <?php endif; ?>
    </section>

</div>
