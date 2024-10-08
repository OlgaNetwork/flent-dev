import React, { useEffect } from 'react';

import { useSerialOperationHandler } from '@bangle.io/api';
import { useNsmSlice } from '@bangle.io/bangle-store-context';
import { RELEASE_ID } from '@bangle.io/config';
import {
  CORE_OPERATIONS_SERVICE_WORKER_DISMISS_UPDATE,
  CORE_OPERATIONS_SERVICE_WORKER_RELOAD,
  SEVERITY,
} from '@bangle.io/constants';
import { nsmNotification } from '@bangle.io/slice-notification';
import { useLocalStorage } from '@bangle.io/utils';

import { useRegisterSW } from './use-sw';

const uid = 'new-version-' + RELEASE_ID;

export function SWReloadPrompt() {
  // replaced dynamically
  const [shownOfflineReady, updateShownOfflineReady] = useLocalStorage(
    'sw-show-offline',
    false,
  );

  const [, notificationDispatch] = useNsmSlice(
    nsmNotification.nsmNotificationSlice,
  );
  const { needRefresh, offlineReady, acceptPrompt, closePrompt } =
    useRegisterSW();
  useEffect(() => {
    if (offlineReady && !shownOfflineReady) {
      updateShownOfflineReady(true);
      notificationDispatch(
        nsmNotification.showNotification({
          uid: 'offline-' + RELEASE_ID,
          severity: SEVERITY.INFO,
          title: 'Flent теперь может работать в офлайн',
          transient: true,
        }),
      );
    }
  }, [
    shownOfflineReady,
    notificationDispatch,
    offlineReady,
    updateShownOfflineReady,
  ]);

  useSerialOperationHandler(
    (sOperation) => {
      if (sOperation.name === CORE_OPERATIONS_SERVICE_WORKER_RELOAD) {
        notificationDispatch(nsmNotification.dismissNotification(uid));
        acceptPrompt();

        return true;
      }
      if (sOperation.name === CORE_OPERATIONS_SERVICE_WORKER_DISMISS_UPDATE) {
        notificationDispatch(nsmNotification.dismissNotification(uid));
        closePrompt();

        return true;
      }

      return false;
    },
    [acceptPrompt, notificationDispatch, closePrompt],
  );

  useEffect(() => {
    if (needRefresh) {
      notificationDispatch(
        nsmNotification.showNotification({
          severity: SEVERITY.INFO,
          uid,
          title: 'Flent',
          content: `Доступна новая версия`,
          buttons: [
            {
              title: 'Обновить',
              hint: `Перезагрузим страницу с новой версией`,
              operation: CORE_OPERATIONS_SERVICE_WORKER_RELOAD,
            },
            {
              title: 'Позднее',
              hint: `Перезагрузим страницу с новой версией`,
              operation: CORE_OPERATIONS_SERVICE_WORKER_RELOAD,
            },
          ],
        }),
      );
    }
  }, [acceptPrompt, needRefresh, closePrompt, notificationDispatch]);

  return null;
}
