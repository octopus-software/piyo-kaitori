<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseOfferUnapprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $purchase_offer_id;
    public $purchase_targets;

    /**
     * Create a new message instance.
     */
    public function __construct($purchase_offer_id,$purchase_targets)
    {
        $this->purchase_offer_id = $purchase_offer_id;
        $this->purchase_targets = $purchase_targets;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '【ぴよ買取】お客様が買取オファーを作成しました。',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.purchase_offer_unapproved_mail',
            with:[
                'purchase_offer_id' => $this->purchase_offer_id,
                'purchase_targets' => $this->purchase_targets,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
