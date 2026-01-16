<?php
use Phalcon\ModelBase;

class TresorerieOperationsBancaires extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $tropba_id;

	/**
	 * @Column(column='provider', type='', mtype='enum', nullable=false, default='qonto', 'length': 'qonto,autre')
	 */
	public $tropba_provider;

	/**
	 * @Column(column='external_id', type='text', mtype='text', nullable=true)
	 */
	public $tropba_external_id;

	/**
	 * @Column(column='date_operation', type='date', mtype='date', nullable=false, key='MUL')
	 */
	public $tropba_date_operation;

	/**
	 * @Column(column='label', type='text', mtype='text', nullable=false)
	 */
	public $tropba_label;

	/**
	 * @Column(column='montant', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $tropba_montant;

	/**
	 * @Column(column='sens', type='', mtype='enum', nullable=false, 'length': 'credit,debit')
	 */
	public $tropba_sens;

	/**
	 * @Column(column='categorie_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $tropba_categorie_id;

	/**
	 * @Column(column='matched_depense_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $tropba_matched_depense_id;

	/**
	 * @Column(column='matched_revenu_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $tropba_matched_revenu_id;

	/**
	 * @Column(column='meta', type='', mtype='json', nullable=true)
	 */
	public $tropba_meta;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $tropba_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('tropba_categorie_id', 'TresorerieCategories', 'trca_id', array('alias' => 'tresorerie_categories_categorie_id'));
		$this->belongsTo('tropba_matched_depense_id', 'TresorerieDepenses', 'trde_id', array('alias' => 'tresorerie_depenses_matched_depense_id'));
		$this->belongsTo('tropba_matched_revenu_id', 'TresorerieRevenus', 'trre_id', array('alias' => 'tresorerie_revenus_matched_revenu_id'));

        $this->setSource('tresorerie_operations_bancaires');
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
            'id' => 'tropba_id',
			'provider' => 'tropba_provider',
			'external_id' => 'tropba_external_id',
			'date_operation' => 'tropba_date_operation',
			'label' => 'tropba_label',
			'montant' => 'tropba_montant',
			'sens' => 'tropba_sens',
			'categorie_id' => 'tropba_categorie_id',
			'matched_depense_id' => 'tropba_matched_depense_id',
			'matched_revenu_id' => 'tropba_matched_revenu_id',
			'meta' => 'tropba_meta',
			'created_at' => 'tropba_created_at'
        );
    }

}
