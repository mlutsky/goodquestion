                
                <?php if($header): ?>
                    <li>
                        <?= $header ?>
                    </li>
                <?php endif; ?>
                
                <?php foreach ($courses as $course): ?>
                    <li>
                         <? if($search == 'true'): ?>
                            <?= "<a href=\"/courses/course/" . $course->id . "/search\">"; ?>
                         <? else: ?>
                            <?= "<a href=\"/courses/course/" . $course->id . "\">"; ?>
                         <? endif; ?>
                        <h3><?=$course->title; ?></h3>
                        <h4><?=$course->courseNum; ?></h4>
                        </a>
                    </li>
                <?php endforeach ?>
                
            
            
