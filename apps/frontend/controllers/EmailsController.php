<?php

use Phalcon\ControllerBase;

/**
 * EmailsController (JSON only)
 * Remplace les Edge Functions Supabase (ex: sync-emails) par des endpoints Phalcon.
 */
class EmailsController extends ControllerBase
{
    /**
     * POST /api/emails/sync
     * Body:
     *  - account_id (string, required) OR "all"
     *  - full_resync (bool, optional)
     *  - reconcile_only (bool, optional)
     *
     * MVP: Stub (renvoie 0) - l'implémentation IMAP viendra ensuite.
     */
    public function syncAction(): void
    {
        $this->view->disable();
        Rest::init();
        Rest::checkParams(['account_id']);

        $accountId = (string) Rest::$params['account_id'];
        $fullResync = (bool) (Rest::$params['full_resync'] ?? false);
        $reconcileOnly = (bool) (Rest::$params['reconcile_only'] ?? false);

        // TODO: implémenter la vraie synchronisation IMAP/SMTP.
        // Pour l'instant, on renvoie un payload compatible avec le hook React useEmailSync().
        if ($reconcileOnly) {
            Rest::renderSuccess([
                'deleted_count' => 0,
                'account_id' => $accountId,
            ]);
        }

        Rest::renderSuccess([
            'emailsSynced' => 0,
            'account_id' => $accountId,
            'full_resync' => $fullResync,
        ]);
    }
}