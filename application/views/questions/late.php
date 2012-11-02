                

                <li>
                <h1 id="subtitle"><?= $eventTitle; ?></h1>
                </li>
                <li>
                    <h2>Users who proposed the top-rated questions:</h2>
                </li>
                <?php for ($i = 0; $i < sizeof($users); $i++): ?>
                    <?php foreach ($users[$i] as $user): ?>
                    <li>
                        <span style="display:inline-block">
                        <h3><?= $user->name; ?></h3>
                        <h3><?= $questions[$i]->text; ?></h3>
                        </span>
                    </li>
                    <?php endforeach ?>
                <?php endfor; ?>
