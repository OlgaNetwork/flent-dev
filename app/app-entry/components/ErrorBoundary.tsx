import React from 'react';
import type { FallbackProps } from 'react-error-boundary';

export function ErrorBoundary({ error }: FallbackProps) {
  return (
    <div className="w-full p-4">
      <div className="w-full p-4 rounded-md B-ui-components_bangle-error-boundary">
        <div className="w-full text-5xl text-center">🤕</div>
        <h1 className="w-full my-4 text-center">Какая-то ошибка</h1>
        <div className="w-full text-sm text-center">
          
          <div className="w-full text-sm italic text-center">
            Error: {error?.name + ':' + error?.message}
          </div>
        </div>
      </div>
    </div>
  );
}
