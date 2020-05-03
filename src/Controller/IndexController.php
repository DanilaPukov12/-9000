<?php

namespace App\Controller;

use App\Form\ContactFeedbackType;
use App\Form\OrderType;
use App\Services\FeedbackMailer;
use App\Services\OrderMailer;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class IndexController extends AbstractController
{
    /**
     * Регистрируем маршрут "/" для главной страницы
     * @Route("/", name="index")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param FeedbackMailer $feedbackMailer
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $em, FeedbackMailer $feedbackMailer)
    {
        // Request для получения get или post данных, которые пришли вместе с заросом
        // FeedbackMailer - сервис для отправки сообщений на почту, который прислал клиент в request
        // EntityManagerInterface $em - для работы с базой данных.

        // Создаем объект формы
        $formFeedback = $this->createForm(ContactFeedbackType::class);

        // Отправляем request форме, чтобы она сама вытащила данные из request и заполнила данными форму
        $formFeedback->handleRequest($request);

        // Проверяем была ли отправлена форма и валидна ли она
        // Если форма отправлена и прошла проверку валидности
        if($formFeedback->isSubmitted() && $formFeedback->isValid()) {
            // Получаем данные обратной связи в из формы
            $feedback = $formFeedback->getData();

            // сообщаем Doctrine, что вы хотите (в конце концов) сохранить Продукт (пока нет запросов)
            $em->persist($feedback);

            // Отправлем запрос бд, чтобы сохранить данные
            $em->flush();

            // Регистируем сообщение об успешной отправки данных из формы
            $this->addFlash('form.feedback.success', "Спасибо за сообщение! Оно будет обязательно рассмотрено");

            // Отправляем данные из формы сервесу, который работает с почтой, чтобы он отправил сообщение на почту клиенту
            $feedbackMailer->send($feedback);

            // Перенаправляем пользователя обратно на главную страницу
            return $this->redirectToRoute('index');
        }


        // Обрабатываем шаблон главной страницы и отправляем ей переменные
        // Срабатывает если:
        // 1. Кто-то зашел на главную страницу
        // 2. Форма не отправлена
        // 3. Отправленная форма не прошла валидацию
        return $this->render('index/index.html.twig', [
            // контролллер нейм не нужен, мне лень было удалить
            'controller_name' => 'IndexController',
            // Созданем вид формы обратной связи
            'form_feedback' => $formFeedback->createView(),
            // Создаем объект формы заказаов и из этого объекта создаем вид формы
            'form_order' => $this->createForm(OrderType::class)->createView(),
            // is_home для того, что был выделен пункт меню "главная"
            'is_home' => 'active'
        ]);
    }
}
