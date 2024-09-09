import React, { useCallback, useEffect, useState } from 'react';

import { nsmApi2 } from '@bangle.io/api';
import {
  Dialog,
  ErrorBanner,
  ExternalLink,
  GithubIcon,
  TextField,
} from '@bangle.io/ui-components';
import { useDebouncedValue } from '@bangle.io/utils';

import {
  NEW_GITHUB_WORKSPACE_REPO_PICKER_DIALOG,
  NEW_GITHUB_WORKSPACE_TOKEN_DIALOG,
} from '../common';
import { getGhToken, updateGhToken } from '../database';
import { ALLOWED_GH_SCOPES, hasValidGithubScope } from '../github-api-helpers';

const MIN_HEIGHT = 200;

export function NewGithubWorkspaceTokenDialog() {
  const [inputToken, updateInputToken] = useState<string | undefined>(
    undefined,
  );
  const [isLoading, updateIsLoading] = useState(false);
  const [error, updateError] = useState<Error | undefined>(undefined);

  const deferredIsLoading = useDebouncedValue(isLoading, { wait: 100 });

  useEffect(() => {
    getGhToken().then((token) => {
      if (token) {
        updateInputToken(token);
      }
    });
  }, []);

  const onNext = useCallback(async () => {
    if (!inputToken) {
      return;
    }
    try {
      updateIsLoading(true);
      updateError(undefined);

      if (!(await hasValidGithubScope({ token: inputToken }))) {
        throw new Error(
          `Bangle.io requires the one of the following scopes: ${ALLOWED_GH_SCOPES.join(
            ', ',
          )}`,
        );
      }
      await updateGhToken(inputToken);
      nsmApi2.ui.showDialog({
        dialogName: NEW_GITHUB_WORKSPACE_REPO_PICKER_DIALOG,
        metadata: {
          githubToken: inputToken,
        },
      });
    } catch (error) {
      if (error instanceof Error) {
        updateError(error);
      }
    } finally {
      updateIsLoading(false);
    }
  }, [inputToken]);

  const onKeyDown = useCallback(
    (e) => {
      if (e.key === 'Enter') {
        onNext();
      }
    },
    [onNext],
  );

  return (
    <Dialog
      isDismissable
      headingTitle="Облако"
      dismissText="Закрыть"
      isLoading={deferredIsLoading}
      primaryButtonConfig={{
        text: 'Далее',
        disabled: !inputToken || inputToken.length === 0,
        onPress: onNext,
      }}
      onDismiss={() => {
        nsmApi2.ui.dismissDialog(NEW_GITHUB_WORKSPACE_TOKEN_DIALOG);
      }}
      headingIcon={""}
      footer={""}
    >
      <div style={{ minHeight: MIN_HEIGHT }}>
        Есть пожелания от пользователей, чтобы во Flent можно было синхронизировать отдельные выбранные проекты через интернет. Возможно такая функция появится. Если вам нравится эта идея, дайте нам знать.
        <div className="my-4">
          
        </div>
      </div>
    </Dialog>
  );
}
