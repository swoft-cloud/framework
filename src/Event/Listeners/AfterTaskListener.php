<?php

namespace Swoft\Event\Listeners;

use Swoft\App;
use Swoft\Base\RequestContext;
use Swoft\Bean\Annotation\Listener;
use Swoft\Event\AppEvent;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Task\Task;

/**
 * 任务后置事件
 *
 * @Listener(AppEvent::AFTER_TASK)
 * @uses      AfterTaskListener
 * @version   2017年09月26日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class AfterTaskListener implements EventHandlerInterface
{
    /**
     * 事件回调
     *
     * @param EventInterface $event      事件对象
     */
    public function handle(EventInterface $event)
    {
        if (\count($event->getParams()) <= 0) {
            return ;
        }

        $type = $event->getParam(0);
        App::getLogger()->appendNoticeLog(true);

        if ($type != Task::TYPE_CRON) {
            RequestContext::destroy();
        }
    }
}
