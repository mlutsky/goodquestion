                
                <?php if (!$events): ?>
                    <li>
                        No events found. Make sure to put in the event code exactly as it is! 
                    </li>
                <?php endif ?>
                <?php foreach ($events as $event): ?>
                    <li>
                         <?= "<a href=\"/main/questions/" . $event->id . "\">"; ?>
                        <h3><?=$event->title; ?></h3>
                        <br />
                        Start time: <h4><?=$event->start_time; ?></h4>
                        End time: <h4><?=$event->end_time; ?></h4>
                        </a>
                    </li>
                <?php endforeach ?>
