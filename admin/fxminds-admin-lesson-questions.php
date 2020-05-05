<?php 

?>

<div class="wrap fxminds-admin">
    <header>
        <h1>FXMinds Students<span>Verdiepingsvragen</span></h1>
    </header>
    <section>
    <?
       $questionArgs = array(
        'numberposts' => -1,
        'post_type'  => 'fxminds_further_qa',

      );
        $questions = get_posts($questionArgs); 
        foreach($questions as $question){
            var_dump(get_post_meta($question->ID));
        }
    ?>

    </section>
    verzin hier nog iets op.
</div>
