<?php
use Phalcon\ModelBase;

class RdEpics extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rdep_id;

	/**
	 * @Column(column='projet_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rdep_projet_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $rdep_titre;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $rdep_description;

	/**
	 * @Column(column='priorite', type='', mtype='enum', nullable=false, default='medium', 'length': 'low,medium,high,critical')
	 */
	public $rdep_priorite;

	/**
	 * @Column(column='couleur', type='text', mtype='text', nullable=true)
	 */
	public $rdep_couleur;

	/**
	 * @Column(column='ordre', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $rdep_ordre;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='todo', 'length': 'todo,in_progress,done')
	 */
	public $rdep_statut;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rdep_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $rdep_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('rdep_id', 'RdUserStories', 'rdusst_epic_id', array('alias' => 'rd_user_stories_epic_id'));

		$this->belongsTo('rdep_projet_id', 'RdProjets', 'rdpr_id', array('alias' => 'rd_projets_projet_id'));

        $this->setSource('rd_epics');
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
            'id' => 'rdep_id',
			'projet_id' => 'rdep_projet_id',
			'titre' => 'rdep_titre',
			'description' => 'rdep_description',
			'priorite' => 'rdep_priorite',
			'couleur' => 'rdep_couleur',
			'ordre' => 'rdep_ordre',
			'statut' => 'rdep_statut',
			'created_at' => 'rdep_created_at',
			'updated_at' => 'rdep_updated_at'
        );
    }

}
