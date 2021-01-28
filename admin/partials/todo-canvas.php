<div class="container">
	<div class="wdt-container">
<!--		<div class="wdt-header">-->
<!--			<span><span>5</span> Tasks</span>-->
			<!--       <ul> -->
			<!--         <li><a href="#">All</a></li> -->
			<!--         <li><a href="#">Active</a></li> -->
			<!--         <li><a href="#">Completed</a></li> -->
			<!--       </ul> -->
<!--		</div>-->
		<div class="wdt-content">
			<input type="text" placeholder="Type your task and press enter" class="wdt-entry-input" />
			<ul class="wdt-tasks">
                <?php
                if ( $todos != [] ) {
                    foreach ($todos as $todo) {
                        ?>
                        <li<?php echo $todo['done'] ? ' class="completed"' : null ?>>
                            <label class="wdt-task">
                                <input type="checkbox" <?php echo $todo['done'] ? 'checked' : null ?> />
                                <span class="wdt-task-content"><?php echo $todo['text']; ?></span>
                            </label>
                            <div class="wdt-actions">
                                <a href="#" class="wdt-trash"><span class="dashicons dashicons-trash"></span></a>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
			</ul>
		</div>
	</div>
</div>