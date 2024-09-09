import React, { useMemo } from 'react';

import { useSerialOperationContext } from '@bangle.io/api';
import {
  useNsmPlainStore,
  useNsmSlice,
  useNsmSliceState,
} from '@bangle.io/bangle-store-context';
import { CORE_OPERATIONS_NEW_NOTE, CorePalette } from '@bangle.io/constants';
import {
  nsmSliceWorkspace,
  pushOpenedWsPaths,
} from '@bangle.io/nsm-slice-workspace';
import type { WsPath } from '@bangle.io/shared-types';
import { nsmUI, nsmUISlice } from '@bangle.io/slice-ui';
import { Button, CenteredBoxedPage } from '@bangle.io/ui-components';
import { removeExtension, resolvePath } from '@bangle.io/ws-path';

import { WorkspaceSpan } from './WorkspaceNeedsAuth';

const MAX_ENTRIES = 200;

function RecentNotes({ wsPaths }: { wsPaths: string[] }) {
  const nsmStore = useNsmPlainStore();
  let new_title = "";
  let new_path = "";

  const formattedPaths = useMemo(() => {
    return wsPaths.map((wsPath) => {
      return resolvePath(wsPath);
    });
  }, [wsPaths]);

  return (
    <div className="mb-1">
      <ul>
        {formattedPaths.map((r, i) => {

new_title = removeExtension(r.fileName);
// Проверяем и обрезаем `new_title ` непосредственно
new_title = (function(title) {
  const parts = title.split(' '); // Разбиваем строку по пробелам

  // Проверяем, есть ли последняя часть строки длиннее или равна 30 символам
  if (parts.length > 1 && parts[parts.length - 1].length >= 30) {
    parts.pop(); // Удаляем последний элемент, если условие выполнено
  }

  return parts.join(' '); // Объединяем части обратно в строку
})(new_title);


new_title = removeExtension(r.fileName);
// Проверяем и обрезаем `new_title ` непосредственно
new_title = (function(title) {
  const parts = title.split(' '); // Разбиваем строку по пробелам

  // Проверяем, есть ли последняя часть строки длиннее или равна 30 символам
  if (parts.length > 1 && parts[parts.length - 1].length >= 30) {
    parts.pop(); // Удаляем последний элемент, если условие выполнено
  }

  return parts.join(' '); // Объединяем части обратно в строку
})(new_title);

const MAX_TITLE_LENGTH = 44;
new_title = new_title.length > MAX_TITLE_LENGTH
  ? new_title.slice(0, MAX_TITLE_LENGTH) + '...'
  : new_title;


new_path = r.dirPath;
/*
// Проверяем и обрезаем `new_title ` непосредственно
new_path = (function(title) {
  const parts = title.split(' '); // Разбиваем строку по пробелам

  // Проверяем, есть ли последняя часть строки длиннее или равна 30 символам
  if (parts.length > 1 && parts[parts.length - 1].length >= 20) {
    parts.pop(); // Удаляем последний элемент, если условие выполнено
  }

  return parts.join(' '); // Объединяем части обратно в строку
})(new_path);
*/


      return (
        <li key={i} className="flex items-center">

        <svg className="w-4 h-4 mr-1.5"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
              <button
                role="link"
                onClick={(e) => {
                  nsmStore.dispatch(
                    pushOpenedWsPaths((openedWsPath) => {
                      return openedWsPath.updatePrimaryWsPath(r.wsPath);
                    }),
                  );
                }}
                className="py-1 hover:underline"
              >
                <span>{new_title} </span>
              </button>
            </li>
          );
        })}
      </ul>
    </div>
  );
}

const EMPTY_ARRAY: WsPath[] = [];
export function EmptyEditorPage() {
  const {
    wsName,
    recentWsPaths = EMPTY_ARRAY,
    noteWsPaths,
  } = useNsmSliceState(nsmSliceWorkspace);
  const { dispatchSerialOperation } = useSerialOperationContext();
  const [, uiDispatch] = useNsmSlice(nsmUISlice);
  const paths = Array.from(
    new Set(
      [...recentWsPaths, ...(noteWsPaths || EMPTY_ARRAY)].slice(0, MAX_ENTRIES),
    ),
  );

  return (
    <CenteredBoxedPage
      dataTestId="app-app-entry_pages-empty-editor-page"
      title={wsName && <WorkspaceSpan wsName={wsName} />}
      actions={
        <>
          <Button
            ariaLabel="create note"
            onPress={() => {
              dispatchSerialOperation({
                name: CORE_OPERATIONS_NEW_NOTE,
              });
            }}
            text="+ Добавить запись"
          />
        </>
      }
    >
      {paths.length !== 0 ? (
        <RecentNotes wsPaths={paths} />
      ) : (
        <div className="mb-3">Пока нет ни одной записи</div>
      )}
    </CenteredBoxedPage>
  );
}
