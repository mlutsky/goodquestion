
					<?php foreach ($geneds as $g): ?>
						<li>
							<? echo "<a href=\"/courses/genedCourses/" . $g->name . "\">"; ?>
								<h3><?=$g->name; ?></h3>
							</a>
						</li>
					<?php endforeach ?>
				
