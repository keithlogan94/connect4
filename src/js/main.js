


function runOnLoad (func) {
    window.onload = func;
}

runOnLoad(function () {


    const gl = webgl.prepareWebGlContext(document.getElementById('canvas'));


    const buffers = webgl.initBuffers(gl);

    const programInfo = webgl.initializeProgramInfo(gl, webgl.shaders.colors.vertexSource, webgl.shaders.colors.fragmentSource);

    // Tell WebGL how to pull out the colors from the color buffer
    // into the vertexColor attribute.
    {
        const numComponents = 4;
        const type = gl.FLOAT;
        const normalize = false;
        const stride = 0;
        const offset = 0;
        gl.bindBuffer(gl.ARRAY_BUFFER, buffers.colors);
        gl.vertexAttribPointer(
            programInfo.attribLocations.vertexColor,
            numComponents,
            type,
            normalize,
            stride,
            offset);
        gl.enableVertexAttribArray(
            programInfo.attribLocations.vertexColor);
    }

    webgl.drawScene(gl, programInfo, buffers, mat4);


});






