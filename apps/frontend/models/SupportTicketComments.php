<?php
use Phalcon\ModelBase;

class SupportTicketComments extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $sutico_id;

	/**
	 * @Column(column='ticket_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $sutico_ticket_id;

	/**
	 * @Column(column='author_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $sutico_author_id;

	/**
	 * @Column(column='content', type='text', mtype='longtext', nullable=false)
	 */
	public $sutico_content;

	/**
	 * @Column(column='is_internal', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $sutico_is_internal;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $sutico_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('sutico_author_id', 'Profiles', 'pr_id', array('alias' => 'profiles_author_id'));
		$this->belongsTo('sutico_ticket_id', 'SupportTickets', 'suti_id', array('alias' => 'support_tickets_ticket_id'));

        $this->setSource('support_ticket_comments');
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
            'id' => 'sutico_id',
			'ticket_id' => 'sutico_ticket_id',
			'author_id' => 'sutico_author_id',
			'content' => 'sutico_content',
			'is_internal' => 'sutico_is_internal',
			'created_at' => 'sutico_created_at'
        );
    }

}
