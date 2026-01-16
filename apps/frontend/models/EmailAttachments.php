<?
use Phalcon\ModelBase;

class EmailAttachments extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $emat_id;

	/**
	 * @Column(column='message_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $emat_message_id;

	/**
	 * @Column(column='filename', type='text', mtype='text', nullable=false)
	 */
	public $emat_filename;

	/**
	 * @Column(column='mime_type', type='text', mtype='text', nullable=false)
	 */
	public $emat_mime_type;

	/**
	 * @Column(column='size_bytes', type='integer', mtype='bigint', nullable=false)
	 */
	public $emat_size_bytes;

	/**
	 * @Column(column='storage_bucket', type='text', mtype='text', nullable=false)
	 */
	public $emat_storage_bucket;

	/**
	 * @Column(column='storage_path', type='text', mtype='text', nullable=false)
	 */
	public $emat_storage_path;

	/**
	 * @Column(column='imap_part_id', type='text', mtype='text', nullable=true)
	 */
	public $emat_imap_part_id;

	/**
	 * @Column(column='downloaded', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $emat_downloaded;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $emat_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('emat_message_id', 'EmailMessages', 'emme_id', array('alias' => 'email_messages_message_id'));

        $this->setSource('email_attachments');
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
            'id' => 'emat_id',
			'message_id' => 'emat_message_id',
			'filename' => 'emat_filename',
			'mime_type' => 'emat_mime_type',
			'size_bytes' => 'emat_size_bytes',
			'storage_bucket' => 'emat_storage_bucket',
			'storage_path' => 'emat_storage_path',
			'imap_part_id' => 'emat_imap_part_id',
			'downloaded' => 'emat_downloaded',
			'created_at' => 'emat_created_at'
        );
    }

}
