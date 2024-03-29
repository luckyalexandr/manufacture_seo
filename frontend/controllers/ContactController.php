<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 30.07.18
 * Time: 14:16
 */

namespace frontend\controllers;


use shop\forms\ContactForm;
use shop\services\ContactService;
use Yii;
use yii\web\Controller;

class ContactController extends Controller
{
    private $service;

    public function __construct($id, $module, ContactService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->goHome();
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }

}