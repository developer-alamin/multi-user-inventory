<?php

namespace App\Mail\users;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendMail extends Mailable {
	use Queueable, SerializesModels;
	public $token = "";
	/**
	 * Create a new message instance.
	 */
	public function __construct($forget) {
		$this->token = $forget;
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope {
		return new Envelope(
			subject: 'Send OTP',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content {
		return new Content(
			view: 'frontend.users.sendMail',
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array {
		return [];
	}
}
