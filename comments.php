<?php

//DODAJ DO HEADERA STRONY
/*
<?php if($page->comments): ?>
	 <link rel='stylesheet' type='text/css' href='<?=$config->urls->FieldtypeComments?>comments.css' />
	 <script type='text/javascript' src='<?=$config->urls->FieldtypeComments?>comments.min.js'></script>
 <?php endif; ?>
*/

          // comments
          $limit = 5; // ILOŚĆ KOMENTARZY
          $start = ($input->pageNum - 1) * $limit;
          $comments = $page->comments->slice($start, $limit);
              
           if ($page->comments) {        
            $bl_com = $comments->render(array(
                'headline' => '<h3>Komentarze</h3>',
                'commentHeader' => 'Dodał {cite} w dn. {created} {stars} {votes}',
                'dateFormat' => 'm/d/y - H:i',
                'encoding' => 'UTF-8',
                'admin' => false, // shows unapproved comments if true
                'replyLabel' => 'Odpowiedz',
              ));
            
            $com_f = $page->comments->renderForm(array(
                'headline' => '<h2>Dołącz Do Dyskusji</h2>',
                'pendingMessage' => 'Twoj komentarz musi zostać zatwierdzony Przez Admina',
                'successMessage' => 'Dzięki Twoj Komentarz został zapisany',
                'errorMessage' => 'Wystąpily Bledy i komentarz nie został zatwierdzony',
                'attrs' => array(
                'id' => 'CommentForm',
                'action' => './',
                'method' => 'post',
                'class' => 'comm-form',
                'rows' => 5,
                'cols' => 50,
                ),
                'labels' => array(
                        'cite' => 'Imie',
                        'email' => 'Twoj E-Mail',
                        'text' => 'Komentarz',
                        'submit' => 'Wyślij',
                    ),
                ));
                echo $bl_com;
                echo $com_f;
          }

            if($input->pageNum > 1) {
                echo "<a href='./page" . ($input->pageNum - 1) . "'>&laquo; Poprzedni</a> ";
            }
            if($start + $limit < count($page->comments)) {
                echo "<a href='./page" . ($input->pageNum + 1) . "'>Następny &raquo;</a> ";
            }
    ?>