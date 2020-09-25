<?php foreach($workers as $worker): ?>
    <fieldset data-js-view="worker" data-log-url=<?php echo route('facilitador.workers@tail', strtolower(urlencode($worker->getName())))?> data-interval="<?php echo $worker->currentInterval('raw')?>">
        <div class="legend sidebar-header"><?php echo ucwords(str_replace(':', ' : ', $worker->getName())) ?>

            <div class="float-right actions">
                <span class="status">
                    <?php if ($worker->isRunning() == 'ok') : ?>
                        <span class="glyphicon glyphicon-ok"></span>
                    <?php else: ?>
                        <span class="glyphicon glyphicon-question-sign"></span>
                    <?php endif ?>
                    Rate: <strong><?php echo $worker->currentInterval('abbreviated')?></strong>
                    </span>
                <a class="btn btn-sm outline">Logs</a>
            </div>

        </div>
        <div class="worker-entry">

            <p><?php echo $worker->getDescription()?></p>

            <ul>
                <li>Last worker execution: <?php echo $worker->lastHeartbeat()?></li>
                <li>Last heartbeat<?php if(!$worker->isRunning()) :?> (and execution)<?php 
               endif?>: <?php echo $worker->lastHeartbeatCheck()?></li>
                <li>Currently executing every: <?php echo $worker->currentInterval()?></li>
            </ul>

            <div class="log closed">Loading...</div>
        </div>
    </fieldset>
<?php endforeach ?>
