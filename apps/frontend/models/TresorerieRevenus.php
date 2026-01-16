<?
use Phalcon\ModelBase;

class TresorerieRevenus extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $trre_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $trre_nom;

	/**
	 * @Column(column='montant', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $trre_montant;

	/**
	 * @Column(column='date_prevue', type='date', mtype='date', nullable=false, key='MUL')
	 */
	public $trre_date_prevue;

	/**
	 * @Column(column='date_encaissement', type='date', mtype='date', nullable=true)
	 */
	public $trre_date_encaissement;

	/**
	 * @Column(column='categorie_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $trre_categorie_id;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='prevu', key='MUL', 'length': 'prevu,encaisse,annule')
	 */
	public $trre_statut;

	/**
	 * @Column(column='notes', type='text', mtype='text', nullable=true)
	 */
	public $trre_notes;

	/**
	 * @Column(column='est_recurrent', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $trre_est_recurrent;

	/**
	 * @Column(column='frequence', type='', mtype='enum', nullable=true, 'length': 'weekly,monthly,quarterly,yearly')
	 */
	public $trre_frequence;

	/**
	 * @Column(column='source', type='string', mtype='varchar', nullable=true, 'length': 64)
	 */
	public $trre_source;

	/**
	 * @Column(column='source_id', type='text', mtype='text', nullable=true)
	 */
	public $trre_source_id;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $trre_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $trre_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('trre_id', 'TresorerieOperationsBancaires', 'tropba_matched_revenu_id', array('alias' => 'tresorerie_operations_bancaires_matched_revenu_id'));

		$this->belongsTo('trre_categorie_id', 'TresorerieCategories', 'trca_id', array('alias' => 'tresorerie_categories_categorie_id'));

        $this->setSource('tresorerie_revenus');
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
            'id' => 'trre_id',
			'nom' => 'trre_nom',
			'montant' => 'trre_montant',
			'date_prevue' => 'trre_date_prevue',
			'date_encaissement' => 'trre_date_encaissement',
			'categorie_id' => 'trre_categorie_id',
			'statut' => 'trre_statut',
			'notes' => 'trre_notes',
			'est_recurrent' => 'trre_est_recurrent',
			'frequence' => 'trre_frequence',
			'source' => 'trre_source',
			'source_id' => 'trre_source_id',
			'created_at' => 'trre_created_at',
			'updated_at' => 'trre_updated_at'
        );
    }

}
