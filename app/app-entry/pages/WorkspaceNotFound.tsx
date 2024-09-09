import React from 'react';

import { useSerialOperationContext } from '@bangle.io/api';
import { useNsmSlice } from '@bangle.io/bangle-store-context';
import {
  CORE_OPERATIONS_NEW_WORKSPACE,
  CorePalette,
} from '@bangle.io/constants';
import { nsmUI, nsmUISlice } from '@bangle.io/slice-ui';
import { Button, CenteredBoxedPage } from '@bangle.io/ui-components';

import { WorkspaceSpan } from './WorkspaceNeedsAuth';

export function WorkspaceNotFound({ wsName }: { wsName?: string }) {
  // wsName can't be read here from the store because it is not found
  const { dispatchSerialOperation } = useSerialOperationContext();
  const [, uiDispatch] = useNsmSlice(nsmUISlice);

  wsName = decodeURIComponent(wsName || '');

  return (
    <CenteredBoxedPage
      title={
        <span className="font-normal">
          {wsName || ''}
          <span className="pl-1"> не найден</span>
        </span>
      }
      actions={
        <>
          <Button
            ariaLabel="open another workspace"
            text="Сменить проект"
            onPress={() => {
              uiDispatch(nsmUI.togglePalette(CorePalette.Workspace));
            }}
          />
          <Button
            ariaLabel="new workspace"
            text="Новый проект"
            onPress={() => {
              dispatchSerialOperation({
                name: CORE_OPERATIONS_NEW_WORKSPACE,
              });
            }}
          />
        </>
      }
    >
      <span>Проект не существует</span>
    </CenteredBoxedPage>
  );
}
