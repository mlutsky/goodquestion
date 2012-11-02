</ul>
        </div>
        <?php if ($display == true): ?>
        <div data-role="footer" data-position="fixed">
            <div data-role="navbar">
                <ul>
                <?php if ($page == 'questions'): ?>
                    <?= "<a data-icon='custom' href=\"/main/newQuestion/" . $id ."\" class='ui-btn-active ui-state-persist'>New Question</a></li>"; ?>
                <?php endif; ?>
                </ul>
            </div>
        </div>
        <?php endif;?>
    </div>


    </body>
</html>
