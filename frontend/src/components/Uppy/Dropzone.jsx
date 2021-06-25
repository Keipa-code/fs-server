import React, { Component } from "react";
import { Uppy } from "@uppy/core";
import "@uppy/core/dist/style.css";
import "@uppy/drag-drop/dist/style.css";
import DragDrop from "@uppy/react/lib/DragDrop";
import Tus from '@uppy/tus';
import Dashboard from '@uppy/react';

export default class Dropzone extends Component {
  componentWillMount() {
    this.uppy = new Uppy({ debug: true, autoProceed: true });

    this.uppy.use(Tus, {
      params: {
        endpoint: '/upload/',
        autoRetry: false,
        retryDelays: [0, 1000, 2000, 4000, 8000],
        limit: 1,
        removeFingerprintOnSuccess: true,
      },
      waitForEncoding: true
    });

    this.uppy.use(Dashboard, {
      inline: true,
      target: '#drag-drop-area',
      showLinkToFileUploadResult: true, //Disable if you don't allow GET-calls via Server
    });
  }

  componentWillUnmount() {
    this.uppy.close();
  }

  render() {
    return (
      <div>
        <h3>Select files</h3>
        <DragDrop uppy={this.uppy} />
      </div>
    );
  }
}