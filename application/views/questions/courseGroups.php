
					<?php foreach ($courseGroups as $c): ?>
						<li>
                        <? echo "<a href=\"/courses/courseGroupCourses/" . $c->name . "\">"; ?>
								<h3><?=$c->full_name; ?></h3>
							</a>
						</li>
					<?php endforeach ?>
				
