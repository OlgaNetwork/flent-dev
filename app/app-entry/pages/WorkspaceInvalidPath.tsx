import React from 'react';

import { useSerialOperationContext } from '@bangle.io/api';
import { useNsmSliceDispatch } from '@bangle.io/bangle-store-context';
import {
  CORE_OPERATIONS_NEW_WORKSPACE,
  CorePalette,
} from '@bangle.io/constants';
import { nsmUI, nsmUISlice } from '@bangle.io/slice-ui';
import { Button, CenteredBoxedPage } from '@bangle.io/ui-components';

export function WorkspaceInvalidPath() {
  const { dispatchSerialOperation } = useSerialOperationContext();
  const uiDispatch = useNsmSliceDispatch(nsmUISlice);

  return (
    <CenteredBoxedPage
      title={
        <span className="font-normal">
          <span className="pl-1">404</span>
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
            onPress={() => {
              dispatchSerialOperation({
                name: CORE_OPERATIONS_NEW_WORKSPACE,
              });
            }}
            text="Новый проект"
          />
        </>
      }
    >
      <span>Такой страницы не существует</span>
    </CenteredBoxedPage>
  );
}
