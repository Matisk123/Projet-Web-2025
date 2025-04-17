<?php


namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeStudentMail extends Mailable {
    use Queueable, SerializesModels;

    public $student;
    public $password;

    /**
    * Créer une nouvelle instance de message.
    */
    public function __construct(User $student, $password)
    {
        $this->student = $student;
        $this->password = $password;
    }

    /**
    * Définir le contenu du message.
    */
    public function build()
    {
        return $this->view('emails.welcome_student')
        ->with([
        'student' => $this->student,
        'password' => $this->password,
        ])
        ->subject('Bienvenue étudiant');
    }

    /**
    * Définir les pièces jointes du message (optionnel).
    */
    public function attachments(): array
    {
        return [];
    }
}
