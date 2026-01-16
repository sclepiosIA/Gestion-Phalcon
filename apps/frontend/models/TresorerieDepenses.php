<?
use Phalcon\ModelBase;

class TresorerieDepenses extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $trde_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $trde_nom;

	/**
	 * @Column(column='montant', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $trde_montant;

	/**
	 * @Column(column='date_prevue', type='date', mtype='date', nullable=false, key='MUL')
	 */
	public $trde_date_prevue;

	/**
	 * @Column(column='date_paiement', type='date', mtype='date', nullable=true)
	 */
	public $trde_date_paiement;

	/**
	 * @Column(column='categorie_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $trde_categorie_id;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='prevu', key='MUL', 'length': 'prevu,paye,annule')
	 */
	public $trde_statut;

	/**
	 * @Column(column='notes', type='text', mtype='text', nullable=true)
	 */
	public $trde_notes;

	/**
	 * @Column(column='est_recurrent', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $trde_est_recurrent;

	/**
	 * @Column(column='frequence', type='', mtype='enum', nullable=true, 'length': 'weekly,monthly,quarterly,yearly')
	 */
	public $trde_frequence;

	/**
	 * @Column(column='source', type='string', mtype='varchar', nullable=true, key='MUL', 'length': 64)
	 */
	public $trde_source;

	/**
	 * @Column(column='source_id', type='text', mtype='text', nullable=true)
	 */
	public $trde_source_id;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $trde_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $trde_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('trde_id', 'TresorerieOperationsBancaires', 'tropba_matched_depense_id', array('alias' => 'tresorerie_operations_bancaires_matched_depense_id'));

		$this->belongsTo('trde_categorie_id', 'TresorerieCategories', 'trca_id', array('alias' => 'tresorerie_categories_categorie_id'));

        $this->setSource('tresorerie_depenses');
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
            'id' => 'trde_id',
			'nom' => 'trde_nom',
			'montant' => 'trde_montant',
			'date_prevue' => 'trde_date_prevue',
			'date_paiement' => 'trde_date_paiement',
			'categorie_id' => 'trde_categorie_id',
			'statut' => 'trde_statut',
			'notes' => 'trde_notes',
			'est_recurrent' => 'trde_est_recurrent',
			'frequence' => 'trde_frequence',
			'source' => 'trde_source',
			'source_id' => 'trde_source_id',
			'created_at' => 'trde_created_at',
			'updated_at' => 'trde_updated_at'
        );
    }

}
