import React, { useCallback, useEffect, useState } from 'react';

import { useSerialOperationContext } from '@bangle.io/api';
import { lastWorkspaceUsed } from '@bangle.io/bangle-store';
import { useNsmSliceDispatch } from '@bangle.io/bangle-store-context';
import { CORE_OPERATIONS_NEW_WORKSPACE } from '@bangle.io/constants';
import type { WorkspaceInfo } from '@bangle.io/shared-types';
import { goToWorkspaceHome, nsmPageSlice } from '@bangle.io/slice-page';
import { Button, CenteredBoxedPage } from '@bangle.io/ui-components';
import { readAllWorkspacesInfo } from '@bangle.io/workspace-info';
import { createWsName } from '@bangle.io/ws-path';

export function LandingPage() {
  const [workspaces, updateWorkspaces] = useState<WorkspaceInfo[]>([]);
  const pageDispatch = useNsmSliceDispatch(nsmPageSlice);

  useEffect(() => {
    let destroyed = false;
    readAllWorkspacesInfo().then((wsInfos) => {
      if (destroyed) {
        return;
      }
      updateWorkspaces(wsInfos);
    });

    return () => {
      destroyed = true;
    };
  }, []);

  const { dispatchSerialOperation } = useSerialOperationContext();

  const onClickWsName = useCallback(
    (wsName: string) => {
      pageDispatch(
        goToWorkspaceHome({
          wsName: createWsName(wsName),
          replace: true,
        }),
      );
    },
    [pageDispatch],
  );

  return (
    <CenteredBoxedPage
      title="Мои проекты"
      actions={
        <>
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
      {workspaces.length !== 0 ? (
        <RecentWorkspace
          workspaces={workspaces}
          onClickWsName={onClickWsName}
        />
      ) : (
        <div className="mb-3">У вас пока нет проектов</div>
      )}
    </CenteredBoxedPage>
  );
}

function RecentWorkspace({
  workspaces,
  onClickWsName,
}: {
  workspaces: WorkspaceInfo[];
  onClickWsName: (wsName: string) => void;
}) {
  const [lastWsName] = useState(() => {
    return lastWorkspaceUsed.get();
  });

  return (
    <div className="mb-3" data-test="landing-page">
      <ul className="my-2">
        {workspaces
          .sort((a, b) => {
            if (a.name === lastWsName) {
              return -1;
            }

            if (b.name === lastWsName) {
              return 1;
            }

            return a.name.localeCompare(b.name);
          })
          .map((r, i) => {
            return (
              <li key={i} className="flex items-center">

<svg className="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
<path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>

                <button
                  role="link"
                  onClick={(e) => {
                    onClickWsName(r.name);
                  }}
                  className="py-1 hover:underline"
                >
                  <span>{r.name} </span>
                  {r.name === lastWsName && (
                    <span className="font-light italic text-colorNeutralTextSubdued">
                      (недавно)
                    </span>
                  )}
                </button>
              </li>
            );
          })}
      </ul>
    </div>
  );
}
