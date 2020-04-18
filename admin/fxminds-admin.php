<?php
$args = array(
    'numberposts' => -1,
    'post_type'   => 'sfwd-courses'
  );

$courses = get_posts( $args );
?>
    <div class="wrap fxminds-admin">
    <header>
        <h1>FXMinds Students<span>Cursus Stats</span></h1>
            <form class="fxminds-filters" method="POST">
                <select name="course_id">
                    <?php
                          foreach($courses as $course){
                              if(isset($_POST['course_id']) && $course->ID == $_POST['course_id']){
                                echo "<option value='{$course->ID}' selected>{$course->post_title}</option>" ;
                              }
                              else{
                                echo "<option value='{$course->ID}'>{$course->post_title}</option>" ;
                              }
                            
                        }
                    ?>
                </select>
                <button type="submit"> Filter</button>
            </form> 
        </header>
<?php 

    if(isset($_POST['course_id'])):
        $meta = get_post_meta( $_POST['course_id'], 'course_access_list', true);
        $users = get_users();
        $lessonArgs = array(
            'numberposts' => -1,
            'post_type'  => 'sfwd-lessons',
            'meta_key' => 'course_id',
            'meta_value' => "{$_POST['course_id']}",
            'order' => 'ASC'
          );
        $lessons = get_posts($lessonArgs);    
?>
            <div class="fxminds-students-table">
                <div class="table-head">
                    <div>
                        Naam
                    </div>
                    <div>
                        Progressie
                    </div>
                </div>
                <div class="table-body">
                <?php foreach($users as $user): 
                        $count = 0;
                        $userLessonCheckList = get_user_meta($user->ID, '_sfwd-course_progress')[0][$_POST['course_id']]['lessons'];
                    ?>
                    <div class="table-row">
                        <div class="name">
                            <?php echo $user->display_name; ?>
                        </div>
                        <div class="lesson-progress">
                            <?php foreach($lessons as $lesson): ?>
                                <div class="progress-label <?php if($userLessonCheckList[$lesson->ID] == 1) echo 'checked';?>">
                                    <?php echo $count + 1?>
                                </div>
                            <?php 
                                $count++;
                                endforeach; 
                            ?>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
<?php 
endif;
?>