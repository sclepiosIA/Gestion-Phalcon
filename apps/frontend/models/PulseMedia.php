<?php
use Phalcon\ModelBase;

class PulseMedia extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pume_id;

	/**
	 * @Column(column='message_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pume_message_id;

	/**
	 * @Column(column='file_url', type='text', mtype='text', nullable=false)
	 */
	public $pume_file_url;

	/**
	 * @Column(column='thumbnail_url', type='text', mtype='text', nullable=true)
	 */
	public $pume_thumbnail_url;

	/**
	 * @Column(column='file_type', type='', mtype='enum', nullable=false, 'length': 'image,video,audio,document,other')
	 */
	public $pume_file_type;

	/**
	 * @Column(column='file_name', type='text', mtype='text', nullable=false)
	 */
	public $pume_file_name;

	/**
	 * @Column(column='size_bytes', type='integer', mtype='bigint', nullable=false, default='0')
	 */
	public $pume_size_bytes;

	/**
	 * @Column(column='mime_type', type='text', mtype='text', nullable=true)
	 */
	public $pume_mime_type;

	/**
	 * @Column(column='storage_path', type='text', mtype='text', nullable=true)
	 */
	public $pume_storage_path;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pume_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('pume_message_id', 'PulseMessages', 'pume_id', array('alias' => 'pulse_messages_message_id'));

        $this->setSource('pulse_media');
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
            'id' => 'pume_id',
			'message_id' => 'pume_message_id',
			'file_url' => 'pume_file_url',
			'thumbnail_url' => 'pume_thumbnail_url',
			'file_type' => 'pume_file_type',
			'file_name' => 'pume_file_name',
			'size_bytes' => 'pume_size_bytes',
			'mime_type' => 'pume_mime_type',
			'storage_path' => 'pume_storage_path',
			'created_at' => 'pume_created_at'
        );
    }

}
