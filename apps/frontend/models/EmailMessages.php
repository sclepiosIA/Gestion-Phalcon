<?php
use Phalcon\ModelBase;

class EmailMessages extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $emme_id;

	/**
	 * @Column(column='thread_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $emme_thread_id;

	/**
	 * @Column(column='imap_uid', type='text', mtype='text', nullable=false)
	 */
	public $emme_imap_uid;

	/**
	 * @Column(column='message_id', type='text', mtype='text', nullable=false)
	 */
	public $emme_message_id;

	/**
	 * @Column(column='in_reply_to', type='text', mtype='text', nullable=true)
	 */
	public $emme_in_reply_to;

	/**
	 * @Column(column='reference_headers', type='', mtype='json', nullable=true)
	 */
	public $emme_reference_headers;

	/**
	 * @Column(column='from_address', type='text', mtype='text', nullable=false)
	 */
	public $emme_from_address;

	/**
	 * @Column(column='from_name', type='text', mtype='text', nullable=true)
	 */
	public $emme_from_name;

	/**
	 * @Column(column='to_addresses', type='', mtype='json', nullable=false)
	 */
	public $emme_to_addresses;

	/**
	 * @Column(column='cc_addresses', type='', mtype='json', nullable=true)
	 */
	public $emme_cc_addresses;

	/**
	 * @Column(column='bcc_addresses', type='', mtype='json', nullable=true)
	 */
	public $emme_bcc_addresses;

	/**
	 * @Column(column='reply_to', type='text', mtype='text', nullable=true)
	 */
	public $emme_reply_to;

	/**
	 * @Column(column='subject', type='text', mtype='text', nullable=false)
	 */
	public $emme_subject;

	/**
	 * @Column(column='body_text', type='text', mtype='longtext', nullable=true)
	 */
	public $emme_body_text;

	/**
	 * @Column(column='body_html', type='text', mtype='longtext', nullable=true)
	 */
	public $emme_body_html;

	/**
	 * @Column(column='has_attachments', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $emme_has_attachments;

	/**
	 * @Column(column='attachments_count', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $emme_attachments_count;

	/**
	 * @Column(column='sent_date', type='datetime', mtype='datetime', nullable=false, key='MUL')
	 */
	public $emme_sent_date;

	/**
	 * @Column(column='received_date', type='datetime', mtype='datetime', nullable=false)
	 */
	public $emme_received_date;

	/**
	 * @Column(column='is_read', type='integer', mtype='tinyint', nullable=false, default='0', key='MUL', 'length': 1)
	 */
	public $emme_is_read;

	/**
	 * @Column(column='is_draft', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $emme_is_draft;

	/**
	 * @Column(column='is_sent', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $emme_is_sent;

	/**
	 * @Column(column='flags', type='', mtype='json', nullable=true)
	 */
	public $emme_flags;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $emme_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('emme_id', 'EmailAttachments', 'emat_message_id', array('alias' => 'email_attachments_message_id'));

		$this->belongsTo('emme_thread_id', 'EmailThreads', 'emth_id', array('alias' => 'email_threads_thread_id'));

        $this->setSource('email_messages');
        parent::initialize();
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap():array
    {
        return array(
            'id' => 'emme_id',
			'thread_id' => 'emme_thread_id',
			'imap_uid' => 'emme_imap_uid',
			'message_id' => 'emme_message_id',
			'in_reply_to' => 'emme_in_reply_to',
			'reference_headers' => 'emme_reference_headers',
			'from_address' => 'emme_from_address',
			'from_name' => 'emme_from_name',
			'to_addresses' => 'emme_to_addresses',
			'cc_addresses' => 'emme_cc_addresses',
			'bcc_addresses' => 'emme_bcc_addresses',
			'reply_to' => 'emme_reply_to',
			'subject' => 'emme_subject',
			'body_text' => 'emme_body_text',
			'body_html' => 'emme_body_html',
			'has_attachments' => 'emme_has_attachments',
			'attachments_count' => 'emme_attachments_count',
			'sent_date' => 'emme_sent_date',
			'received_date' => 'emme_received_date',
			'is_read' => 'emme_is_read',
			'is_draft' => 'emme_is_draft',
			'is_sent' => 'emme_is_sent',
			'flags' => 'emme_flags',
			'created_at' => 'emme_created_at'
        );
    }

}
