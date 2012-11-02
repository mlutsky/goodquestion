                

                <li>
                <h1 id="subtitle"><?= $eventTitle; ?></h1>
                </li>
                <li>
                Start Time: <?= $startTime; ?>
                </li>
                <li>
                End Time: <?= $endTime; ?>
                </li>
                <?php foreach ($questions as $question): ?>
                    <li id="<?= $question->id ?>">
                        <span style="display:inline-block">
                        <h3><?= $question->text; ?></h3>
                        <h4>Vote score: <?= $question->votes; ?></h4>
                        </span>

                        <span style="display:inline-block; float:right;">
                        <button class="downvote btn danger" type="button">Vote down</button>
                        </span>

                        <span style="display:inline-block; float:right;">
                        <button class="upvote btn success" type="button">Vote up</button>
                        </span>
                    </li>
                <?php endforeach ?>
