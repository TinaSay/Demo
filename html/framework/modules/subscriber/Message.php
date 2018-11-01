<?php

namespace app\modules\subscriber;

use tina\subscriber\interfaces\MessageInterface;
use tina\subscriber\models\Subscriber;
use Yii;
use yii\base\Action;
use yii\mail\MailerInterface;

/**
 * Class Message
 *
 * @package tina\subscriber
 */
class Message implements MessageInterface
{
    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * Message constructor.
     *
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Subscriber $model
     * @param Action $action
     *
     * @return mixed|\yii\mail\MessageInterface
     */
    public function make(Subscriber $model, Action $action)
    {
        $message = $this->mailer->compose('@vendor/contrib/yii2-subscriber/mail/subscribe', [
            'model' => $model,
        ]);
        $message->setSubject('Сообщение с сайта ЭНСАЙН');
        $message->setTo($model->email);

        return $message;
    }
}
