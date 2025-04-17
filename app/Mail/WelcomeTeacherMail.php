<?php


namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeTeacherMail extends Mailable {
    use Queueable, SerializesModels;

    public $teacher;
    public $password;

    /**
     * Créer une nouvelle instance de message.
     */
    public function __construct(User $teacher, $password)
    {
        $this->teacher = $teacher;
        $this->password = $password;
    }

    /**
     * Définir le contenu du message.
     */
    public function build()
    {
        return $this->view('emails.welcome_teacher')
        ->with([
            'student' => $this->teacher,
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
