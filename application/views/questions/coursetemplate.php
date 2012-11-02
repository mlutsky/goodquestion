
                        <li>
                                <h2><div id="title"><?=$courses['courseinfo'][0]->title; ?></div></h2>
                                <div id="id" style="display:none;"><?=$courses['courseinfo'][0]->id; ?></div>
                        </li>
                        <li>
                            <h4>Professors:
                            <?php foreach ($courses['faculty'] as $f): ?>
                                <div id="professor"><?=$f->lastName; ?></div>
                            <?php endforeach ?>
                            </h4>
                        </li>
                        <li>
                            <h4>Meeting Times:
                            <?php foreach ($courses['time'] as $t): ?>
                               <div id="time"><? echo $t->day; echo "  " . $t->beginTime; echo "  " . $t->endTime; ?></div>
                            <?php endforeach ?>
                            </h4>
                        </li>
                        <li>
                            <?php foreach ($courses['coursegroup'] as $cg): ?>
                                <h4>Department:<div id="department"><?=$cg->name; ?></div></h4>
                            <?php endforeach ?>
                        </li>
                        <li>
                                <h4>GenEd categories:
                                    <div id="geneds">
                                        <?php foreach ($courses['gened'] as $g): ?>
                                            <?=$g->name; ?><br>
                                        <?php endforeach ?>
                                    </div>
                                </h4>
                        </li>
                        <li>
                                <h4>Description:</h4>
                                <?= $courses['courseinfo'][0]->description ?>
                        </li>
                        <li>
                            <button id="shopping-btn" data-icon="plus" data-iconpos="right">Add to courses I'm shopping</button>
                            <button id="taking-btn" data-icon="star" data-iconpos="right">Add to courses I'm taking</button>
                        </li>
                     <?php //endforeach ?>
				
